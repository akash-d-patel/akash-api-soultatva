<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('header_menus')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->string('url')->nullable();
            $table->bigInteger('order')->nullable()->index();
            $table->string('link_type')->default('internal');
            $table->string('link_open_with')->default('current');
            $table->string('upper_top')->default('false')->index();
            $table->string('top')->default('false')->index();
            $table->string('bottom')->default('false')->index();
            $table->string('left')->default('false')->index();
            $table->string('right')->default('false')->index();
            $table->string('is_authentication')->default('no')->index();
            $table->string('status')->default('Active')->index();
         
            // user and time
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('deleted_at')->nullable();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_menus');
    }
}
