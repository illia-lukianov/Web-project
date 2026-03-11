<?php

/**
 * Migration script from SQLite to PostgreSQL
 * This script exports data from SQLite database and imports it to PostgreSQL
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

// Register SQLite connection
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/database.sqlite',
]);

// Register PostgreSQL connection  
$capsule->addConnection([
    'driver' => 'pgsql',
    'host' => getenv('DB_HOST') ?: 'localhost',
    'port' => getenv('DB_PORT') ?: 5432,
    'database' => getenv('DB_DATABASE') ?: 'laravel_db',
    'username' => getenv('DB_USERNAME') ?: 'laravel',
    'password' => getenv('DB_PASSWORD') ?: 'laravel_password',
    'charset' => 'utf8',
    'prefix' => '',
], 'postgres');

$capsule->setAsGlobal();

$sqlite = $capsule->connection('sqlite');
$postgres = $capsule->connection('postgres');

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

echo "Starting migration from SQLite to PostgreSQL...\n";

foreach ($tables as $table) {
    try {
        // Get all records from SQLite
        $records = $sqlite->table($table)->get();
        
        if ($records->count() > 0) {
            // Delete existing records in PostgreSQL (if any)
            $postgres->table($table)->truncate();
            
            // Insert records into PostgreSQL
            foreach ($records as $record) {
                $postgres->table($table)->insert((array)$record);
            }
            
            echo "✓ Migrated {$records->count()} records from {$table}\n";
        } else {
            echo "- No records found in {$table}\n";
        }
    } catch (\Exception $e) {
        echo "✗ Error migrating {$table}: " . $e->getMessage() . "\n";
    }
}

echo "\nMigration completed!\n";
?>
