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
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};


<?php

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
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};

<?php

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
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};

<?php

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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('divisi_id');
            $table->foreign('divisi_id')->references('id')->on('divisis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
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
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('divisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_divisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisi');
    }
};

<?php

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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
            $table->unsignedBigInteger('kompetensi_id');
            $table->foreign('kompetensi_id')->references('id')->on('kompetensis');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};

<?php

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
        Schema::create('kompetensis', function (Blueprint $table) {
            $table->id();
            $table->string('kompetensi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kompetensi');
    }
};


File model

<?php

namespace App\Models;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Model;
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

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

File Controler
<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function datatable()
    {
        return view('datatable');
    }
    public function viewtambahkaryawan()
    {
        return view('tambah-karyawan');
    }
    public function tambahkaryawan(Request $r)
    {
        $ky = new Karyawan();
        $ky->nama = $r->nama;
        $ky->divisi_id = $r->divisi;
        $ky->save();
        $nki = Karyawan::latest()->get();

        $n = new Penilaian();
        $n->karyawan_id = $nki[0]->id;
        $n->kompetensi_id = 1;
        $n->nilai = 0;
        $n->save();

        $n2 = new Penilaian();
        $n2->karyawan_id = $nki[0]->id;
        $n2->kompetensi_id = 2;
        $n2->nilai = 0;
        $n2->save();

        $n3 = new Penilaian();
        $n3->karyawan_id = $nki[0]->id;
        $n3->kompetensi_id = 3;
        $n3->nilai = 0;
        $n3->save();

        $n4 = new Penilaian();
        $n4->karyawan_id = $nki[0]->id;
        $n4->kompetensi_id = 4;
        $n4->nilai = 0;
        $n4->save();

        $n5 = new Penilaian();
        $n5->karyawan_id = $nki[0]->id;
        $n5->kompetensi_id = 5;
        $n5->nilai = 0;
        $n5->save();
        return redirect('/dashboard');
    }
    public function lihatdash()
    {

        $ky = Karyawan::with('divisi', 'penilaian')->get();
        // dd($ky[0]->penilaian[0]->nilai);
        return view('dashboard', compact('ky'));
    }
    public function vieweditkaryawan($id)
    {
        $k = Karyawan::find($id);
        return view('formeditkaryawan', compact('k'));
    }
    public function updatekaryawan(Request $r)
    {
        $ky = Karyawan::find($r->id);
        $ky->nama = $r->nama;
        $ky->divisi_id = $r->divisi;
        $ky->save();
        return redirect('/dashboard');
    }
    public function hapuskaryawan($id)
    {
        $k = Karyawan::find($id);
        $k->delete();
        return redirect('/dashboard');
    }
    public function viewnilaikaryawan($id)
    {
        // $h = 0;
        // $t = 0;
        // $k = 0;
        // $d = Penilaian::where()

        $ky = Karyawan::find($id);
        return view('formnilaikaryawan', compact('ky'));
    }
    public function updatenilai(Request $r)
    {
        // $h = 0;
        // $t = 0;
        // $k = 0;
        // $d = Penilaian::where()
        $x = Penilaian::where('karyawan_id', $r->id)->delete();

        $n = new Penilaian();
        $n->karyawan_id = $r->id;
        $n->kompetensi_id = 1;
        $n->nilai = $r->penhadir;
        $n->save();

        $n2 = new Penilaian();
        $n2->karyawan_id = $r->id;
        $n2->kompetensi_id = 2;
        $n2->nilai = $r->penkre;
        $n2->save();

        $n3 = new Penilaian();
        $n3->karyawan_id = $r->id;
        $n3->kompetensi_id = 3;
        $n3->nilai = $r->penket;
        $n3->save();

        $n4 = new Penilaian();
        $n4->karyawan_id = $r->id;
        $n4->kompetensi_id = 4;
        $n4->nilai = $r->penpro;
        $n4->save();

        $n5 = new Penilaian();
        $n5->karyawan_id = $r->id;
        $n5->kompetensi_id = 5;
        $n5->nilai = $r->penker;
        $n5->save();
        return redirect('dashboard');
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

