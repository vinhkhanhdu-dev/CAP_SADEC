    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('quanlythongtinkhuvuc', function (Blueprint $table) {
                $table->id();
                $table->string('maKhuVuc', 255)->unique();
                $table->string('tenKhuVuc', 255);
                $table->string('ghiChu', 255);
                $table->string('maKhuVucCha', 255);
                
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('quanlythongtinkhuvuc');
        }
    };