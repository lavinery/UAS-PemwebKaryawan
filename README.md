<a name="br1"></a> 

Muhammad Syaiful Latif (H1D022025)

<https://github.com/lavinery/UAS-PemwebKaryawan.git>



<a name="br2"></a> 



<a name="br3"></a> 



<a name="br4"></a> 

Login : admin@admin pass: 12345678

File migrations

<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;



<a name="br5"></a> 

use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

/\*\*

\* Run the migrations.

\*/

public function up(): void

{

Schema::create('divisis', function (Blueprint $table) {

$table->id();

$table->string('nama\_divisi');

$table->timestamps();

});

}

/\*\*

\* Reverse the migrations.

\*/

public function down(): void

{

Schema::dropIfExists('divisi');

}

};



<a name="br6"></a> 

<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

/\*\*

\* Run the migrations.

\*/

public function up(): void

{

Schema::create('karyawans', function (Blueprint $table) {

$table->id();

$table->string('nama');

$table->unsignedBigInteger('divisi\_id');

$table->foreign('divisi\_id')->references('id')->on('divisis');

$table->timestamps();

});

}

/\*\*

\* Reverse the migrations.

\*/

public function down(): void



<a name="br7"></a> 

{

Schema::dropIfExists('karyawan');

}

};

<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

/\*\*

\* Run the migrations.

\*/

public function up(): void

{

Schema::create('kompetensis', function (Blueprint $table) {

$table->id();

$table->string('kompetensi');

$table->timestamps();

});

}



<a name="br8"></a> 

/\*\*

\* Reverse the migrations.

\*/

public function down(): void

{

Schema::dropIfExists('kompetensi');

}

};

<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

/\*\*

\* Run the migrations.

\*/

public function up(): void

{

Schema::create('penilaians', function (Blueprint $table) {

$table->id();

$table->unsignedBigInteger('karyawan\_id');



<a name="br9"></a> 

$table->foreign('karyawan\_id')->references('id')->on('karyawan

s')->onDelete('cascade');

$table->unsignedBigInteger('kompetensi\_id');

$table->foreign('kompetensi\_id')->references('id')->on('kompet

ensis');

$table->integer('nilai');

$table->timestamps();

});

}

/\*\*

\* Reverse the migrations.

\*/

public function down(): void

{

Schema::dropIfExists('penilaian');

}

};

File model

<?php

namespace App\Models;

use App\Models\Karyawan;

use Illuminate\Database\Eloquent\Model;



<a name="br10"></a> 

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Divisi extends Model

{

use HasFactory;

public function karyawan()

{

return $this->hasMany(Karyawan::class);

}

}

<?php

namespace App\Models;

use App\Models\Divisi;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model

{

use HasFactory;

public function divisi()

{

return $this->belongsTo(Divisi::class);



<a name="br11"></a> 

}

public function penilaian()

{

return $this->hasMany(Penilaian::class);

}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model

{

use HasFactory;

public function penilaian()

{

return $this->hasMany(Penilaian::class);

}

}

<?php



<a name="br12"></a> 

namespace App\Models;

use App\Models\Karyawan;

use App\Models\Kompetensi;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model

{

use HasFactory;

public function karyawan()

{

return $this->belongsTo(Karyawan::class);

}

public function kompetensi()

{

return $this->belongsTo(Kompetensi::class);

}

}

File DatabaseSeeder

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('divisis')->insert([
            'nama_divisi' => "HRD"
        ]);
        DB::table('divisis')->insert([
            'nama_divisi' => "Manager"
        ]);
        DB::table('divisis')->insert([
            'nama_divisi' => "IT"
        ]);

        DB::table('kompetensis')->insert([
            'kompetensi' => "Kehadiran"
        ]);
        DB::table('kompetensis')->insert([
            'kompetensi' => "Tugas Selesai"
        ]);
        DB::table('kompetensis')->insert([
            'kompetensi' => "Kedisiplinan"
        ]);
        DB::table('kompetensis')->insert([
            'kompetensi' => "Kinerja"
        ]);
        DB::table('kompetensis')->insert([
            'kompetensi' => "Keterampilan"
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
