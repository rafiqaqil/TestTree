CMD COMMAND 
php artisan make:model DM5tree -mcr

C:\Users\Another\Documents\GitHub\TestTree>php artisan make:model DM5tree -mcr
Model created successfully.
Created Migration: 2020_10_15_125153_create_d_m5trees_table
Controller created successfully.


GO TO MODEL UPDATE MODEL 
use Kalnoy\Nestedset\NodeTrait;
use NodeTrait;    
protected $guarded = [];

GO TO MIGRATIONS UPDATE 
use Kalnoy\Nestedset\NodeTrait;
NestedSet::columns($table);

CMD COMMAND 
php artisan migrate


GO TO CONTROLLER UPDATE index function


      public function __construct()
    {
        $this->middleware('auth');
    }
    
 GO TO SEED MAKE SEEDER
 
 php artisan make:seeder DM5treeSeeder
Seeder created successfully.

 add seeder to DatabaseSeeder 
 
 
 go to main controller
 
 
 add webroute to index DM5 cONTROLLER
 
    
    
    