    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('task', function (Blueprint $table) {
                $table->id();
                $table->string('taskCode', 255);
                $table->string('taskName', 255);
                
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('task');
        }
    };