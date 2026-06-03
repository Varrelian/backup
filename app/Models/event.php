class Event extends Model
{
protected $guarded = [];
// [TAMBAHKAN INI] Satu acara dimiliki oleh satu kategori
public function category()
{
return $this->belongsTo(Category::class);
}
}