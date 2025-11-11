    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('nhatkychithu', function (Blueprint $table) {
                $table->id();
                $table->string('code', 255)->unique();
                $table->string('tencongviec', 255)->nullable();
                $table->string('sotienchi', 255)->nullable();
                $table->string('sotienthu', 255)->nullable();
                $table->string('chenhlech', 255)->nullable();
                
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('nhatkychithu');
        }
    };