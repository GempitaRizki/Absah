use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    // ...

    protected $fillable = [
        'name',
        'slug', 
        'parent_id',
        'parent_type_id', // Tambahkan kolom ini
        'hierarchy',
        'hierarchy_name',
        'level',
        'status_id',
        'logo',
        'bash_logo', 
        'descriptions',
        'type_category',
        'dikbud_type',
        'urut',
        'dikbud',
        'kat_agregasi'
    ];

    // ...

    public function parentType()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_type_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
}
