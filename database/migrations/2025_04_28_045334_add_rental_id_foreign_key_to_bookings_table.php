<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRentalIdForeignKeyToBookingsTable extends Migration
{
    public function up()
    {
        // Check if 'rental_id' column already exists, if not, add it
        if (!Schema::hasColumn('bookings', 'rental_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreignId('rental_id')->constrained('rentals')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['rental_id']);
            $table->dropColumn('rental_id');
        });
    }
}

