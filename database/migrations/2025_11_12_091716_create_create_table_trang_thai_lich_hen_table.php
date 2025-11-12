    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('create_table_trang_thai_lich_hen', function (Blueprint $table) {
                $table->id();
                $table->string('maTrangThai', 255)->unique();
                $table->string('tenTrangThai', 255)->unique();
                $table->text('ghiChu')->nullable();
                
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('create_table_trang_thai_lich_hen');
        }
    };