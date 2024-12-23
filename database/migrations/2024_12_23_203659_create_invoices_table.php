<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('company_name');
            $table->string('company_address_line_1');
            $table->string('company_address_line_2')->nullable();
            $table->string('company_city');
            $table->string('company_county')->nullable();
            $table->string('company_postcode');
            $table->string('company_vat_number')->nullable();
            $table->string('client_name');
            $table->string('client_address_line_1');
            $table->string('client_address_line_2')->nullable();
            $table->string('client_city');
            $table->string('client_county')->nullable();
            $table->string('client_postcode');
            $table->longText('note')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->decimal('sub_total', total: 8, places: 2)->nullable();
            $table->integer('vat_percentage')->nullable();
            $table->decimal('total', total: 8, places: 2)->nullable();
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
