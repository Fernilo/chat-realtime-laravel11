<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'aprende a tocar el piano',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tristique molestie volutpat. 
                Mauris fermentum, dui sed tincidunt hendrerit, enim velit egestas mauris, id rhoncus neque risus a eros. 
                Pellentesque cursus augue sit amet risus posuere sollicitudin. Cras ut justo interdum erat rutrum dignissim. 
                Nunc vulputate orci non augue porta, in placerat mauris varius. Vestibulum turpis ex, tincidunt 
                vitae nibh a, sagittis lobortis urna. Vivamus ac ligula vitae nisl semper aliquet id id erat. Cras ultricies dolor ipsum, sit amet ornare arcu tempus a.',
            'slug' => 'aprende-a-tocar-el-piano',
            'user_id' => 1,
        ]); 

        Service::create(
        [
            'name' => 'aprende a tocar la guitarra',
            'description' => 'Donec in lobortis lacus, non vehicula metus. Nam congue volutpat felis, vitae tincidunt arcu vulputate vitae. 
                Pellentesque rutrum pellentesque arcu, condimentum ultricies metus dignissim sit amet. 
                Donec sagittis lectus lacus, et ullamcorper augue fringilla non. Maecenas finibus consectetur tempus. 
                Etiam sit amet scelerisque est. Sed quis massa at tortor tempor tristique. Etiam in velit felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Pellentesque tincidunt non nisi eu facilisis. Aliquam imperdiet nulla sed pretium blandit. Proin porta ullamcorper est, dictum fermentum urna.',
            'slug' => 'aprende-a-tocar-la-guitarra',
            'user_id' => 1,
        ]); 
    }
}
