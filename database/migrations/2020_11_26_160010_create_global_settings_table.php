<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('setup_complete')->default(false);
            $table->integer('setup_progress')->default(1);

            // admin users
            $table->boolean('primary_admin_configured')->default(false);

            // public users
            $table->boolean('has_users')->default(false);
            $table->boolean('has_registration')->default(false);
            $table->boolean('has_password_resets')->default(false);
            $table->boolean('has_email_confirmation')->default(false);

            // contact
            $table->boolean('has_contact_form')->default(false);

            // providers
            $table->enum('file_storage_type', ['local', 'ftp', 'sftp', 's3'])->default('local');
            $table->enum('email_provider_type', ['smtp', 'mailgun', 'postmark', 'ses', 'sendmail'])->default('smtp');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_settings');
    }
}
