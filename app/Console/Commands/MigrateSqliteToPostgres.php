<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\PostgresConnection;

class MigrateSqliteToPostgres extends Command
{
    protected $signature = 'migrate:sqlite-to-postgres {--force : Skip confirmation}';
    protected $description = 'Migrate data from SQLite to PostgreSQL database';

    public function handle()
    {
        if (!$this->option('force') && !$this->confirm('This will copy all data from SQLite to PostgreSQL. Continue?')) {
            return Command::FAILURE;
        }

        // Tables to migrate (order matters for foreign keys)
        $tables = [
            'users',
            'categories',
            'tags',
            'posts',
            'post_tags',
            'portfolio_projects',
            'team_members',
            'testimonials',
            'pricing_plans',
            'pricing_plan_features',
            'home_features',
            'site_settings',
            'about_sections',
            'faq_sections',
            'faq_items',
            'contact_messages',
            'portfolio_project_images',
        ];

        $this->info('Starting migration from SQLite to PostgreSQL...');
        $this->line('');

        try {
            // Get SQLite and PostgreSQL connections
            $sqlite = null;
            $postgres = null;

            // Try to get SQLite connection
            try {
                $sqlite = DB::connection('sqlite');
                $this->info('✓ Connected to SQLite');
            } catch (\Exception $e) {
                // Try to create SQLite connection manually
                try {
                    \DB::setDefaultConnection('sqlite');
                    $sqlite = DB::connection('sqlite');
                    $this->info('✓ Connected to SQLite (fallback)');
                } catch (\Exception $e2) {
                    $this->warn('Could not connect to SQLite: ' . $e2->getMessage());
                }
            }

            if (!$sqlite) {
                $this->error('Could not establish SQLite connection');
                return Command::FAILURE;
            }

            // Get PostgreSQL connection (should be the default)
            try {
                $postgres = DB::connection('pgsql');
                $this->info('✓ Connected to PostgreSQL');
            } catch (\Exception $e) {
                $this->error('Could not connect to PostgreSQL: ' . $e->getMessage());
                return Command::FAILURE;
            }

            $this->line('');

            // Disable foreign key checks for PostgreSQL
            try {
                $postgres->statement('SET CONSTRAINTS ALL DEFERRED;');
            } catch (\Exception $e) {
                $this->warn('Could not defer constraints: ' . $e->getMessage());
            }

            foreach ($tables as $table) {
                try {
                    // Check if table exists in SQLite
                    $sqlite_tables = $sqlite->select("
                        SELECT name FROM sqlite_master 
                        WHERE type='table' AND name=?
                    ", [$table]);

                    if (empty($sqlite_tables)) {
                        $this->line("- Table {$table} not found in SQLite");
                        continue;
                    }

                    // Get records from SQLite
                    $records = $sqlite
                        ->table($table)
                        ->get()
                        ->toArray();

                    if (count($records) > 0) {
                        // Truncate PostgreSQL table to avoid constraint violations
                        try {
                            $postgres->statement('TRUNCATE TABLE ' . $table . ' CASCADE;');
                        } catch (\Exception $e) {
                            $this->warn("  Could not truncate {$table}: " . $e->getMessage());
                        }

                        // Convert stdClass to array
                        $data = array_map(function($record) {
                            return (array)$record;
                        }, $records);

                        // Insert in chunks to handle large datasets
                        $chunks = array_chunk($data, 100);
                        $inserted = 0;
                        
                        foreach ($chunks as $chunk) {
                            try {
                                $postgres
                                    ->table($table)
                                    ->insert($chunk);
                                $inserted += count($chunk);
                            } catch (\Exception $e) {
                                $this->warn("  Error inserting chunk into {$table}: " . $e->getMessage());
                            }
                        }

                        $this->info("✓ Migrated {$inserted} records from {$table}");
                    } else {
                        $this->line("- No records found in {$table}");
                    }
                } catch (\Exception $e) {
                    $this->warn("! Warning for {$table}: " . $e->getMessage());
                }
            }

            // Reset sequences for PostgreSQL
            $this->line('');
            $this->info('Resetting PostgreSQL sequences...');
            
            try {
                $tables_with_id = [
                    'users', 'categories', 'tags', 'posts', 'post_tags',
                    'portfolio_projects', 'team_members', 'testimonials',
                    'pricing_plans', 'pricing_plan_features', 'home_features',
                    'site_settings', 'about_sections', 'faq_sections', 'faq_items',
                    'contact_messages', 'portfolio_project_images'
                ];

                foreach ($tables_with_id as $table) {
                    try {
                        $max_id = $postgres->table($table)->max('id');
                        if ($max_id) {
                            $sequence = $table . '_id_seq';
                            $postgres->statement("ALTER SEQUENCE $sequence RESTART WITH " . ($max_id + 1));
                        }
                    } catch (\Exception $e) {
                        // Skip if sequence doesn't exist or there's no ID
                    }
                }
                $this->info('✓ Sequences reset');
            } catch (\Exception $e) {
                $this->warn('Could not reset sequences: ' . $e->getMessage());
            }

            // Re-enable foreign key checks
            try {
                $postgres->statement('SET CONSTRAINTS ALL IMMEDIATE;');
            } catch (\Exception $e) {
                $this->warn('Could not set immediate constraints: ' . $e->getMessage());
            }

            $this->line('');
            $this->info('✓✓✓ Migration completed successfully! ✓✓✓');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Migration failed: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
?>
