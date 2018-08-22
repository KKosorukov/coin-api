<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\Adv;
use App\Models\Backoffice\Campaign;
use App\Models\Backoffice\AdvGroup;
use App\Models\Backoffice\Banner;
use App\Models\Backoffice\User;
use App\Models\Backoffice\Project;

use Carbon\Carbon;

class AddAdvsExamples extends Migration
{
    private $firstNames = ["Bumblebee", "Bandersnatch", "Broccoli", "Rinkydink", "Bombadil", "Boilerdang", "Bandicoot", "Fragglerock", "Muffintop", "Congleton", "Blubberdick", "Buffalo", "Benadryl", "Butterfree", "Burberry", "Whippersnatch", "Buttermilk", "Beezlebub", "Budapest", "Boilerdang", "Blubberwhale", "Bumberstump", "Bulbasaur", "Cogglesnatch", "Liverswort", "Bodybuild", "Johnnycash", "Bendydick", "Burgerking", "Bonaparte", "Bunsenburner", "Billiardball", "Bukkake", "Baseballmitt", "Blubberbutt", "Baseballbat", "Rumblesack", "Barister", "Danglerack", "Rinkydink", "Bombadil", "Honkytonk", "Billyray", "Bumbleshack", "Snorkeldink", "Beetlejuice", "Bedlington", "Bandicoot", "Boobytrap", "Blenderdick", "Bentobox", "Pallettown", "Wimbledon", "Buttercup", "Blasphemy", "Syphilis", "Snorkeldink", "Brandenburg", "Barbituate", "Snozzlebert", "Tiddleywomp", "Bouillabaisse", "Wellington", "Benetton", "Bendandsnap", "Timothy", "Brewery", "Bentobox", "Brandybuck", "Benjamin", "Buckminster", "Bourgeoisie", "Bakery", "Oscarbait", "Buckyball", "Bourgeoisie", "Burlington", "Buckingham", "Barnoldswick", "Bumblesniff", "Butercup", "Bubblebath","Fiddlestick","Bulbasaur","Bumblebee","Bettyboop","Botany","Cadbury","Brendadirk","Buckingham","Barnabus","Barnacle","Billybong","Botany"];

    private $lastNames = ["Coddleswort", "Crumplesack", "Curdlesnoot", "Calldispatch", "Humperdinck", "Rivendell", "Cuttlefish", "Lingerie", "Vegemite", "Ampersand", "Cumberbund", "Candycrush", "Clombyclomp", "Cragglethatch", "Nottinghill", "Cabbagepatch", "Camouflage","Creamsicle", "Curdlemilk", "Upperclass", "Frumblesnatch", "Crumplehorn", "Talisman", "Candlestick", "Chesterfield", "Bumbersplat", "Scratchnsniff", "Snugglesnatch", "Charizard", "Carrotstick", "Cumbercooch", "Crackerjack", "Crucifix", "Cuckatoo", "Cockletit", "Collywog", "Capncrunch", "Covergirl", "Cumbersnatch", "Countryside","Coggleswort", "Splishnsplash", "Copperwire", "Animorph", "Curdledmilk", "Cheddarcheese", "Cottagecheese", "Crumplehorn", "Snickersbar", "Banglesnatch", "Stinkyrash", "Cameltoe", "Chickenbroth", "Concubine", "Candygram", "Moldyspore", "Chuckecheese", "Cankersore", "Crimpysnitch", "Wafflesmack", "Chowderpants", "Toodlesnoot", "Clavichord", "Cuckooclock", "Oxfordshire", "Cumbersome", "Chickenstrips", "Battleship", "Commonwealth", "Cunningsnatch", "Custardbath", "Kryptonite", "Curdlesnoot", "Cummerbund", "Coochyrash", "Crackerdong", "Crackerdong", "Curdledong", "Crackersprout", "Crumplebutt", "Colonist", "Coochierash", "Anglerfish", "Cumbersniff","Charmander","Scratch-n-sniff","Cumberbitch","Pumpkinpatch","Cramplesnutch","Lumberjack","Bonaparte","Cul-de-sac","Cankersore"];

    private $numUsers = 100; // 10 users
    private $numProjects = 1; // with 1 project
    private $numCampaigns = 3; // with 2 campaigns
    private $numAdvGroups = 3; // with 2 advgroups
    private $numAdvs = 3; // with 5 advertises
    private $numBanners = 1; // with 4 banners

    /**
     * Generate banners for adv
     *
     * @param $newUser
     * @param $newProject
     * @param $newCampaign
     * @param $newAdvGroup
     * @param $newAdv
     */
    private function _generateBanners($newUser, $newProject, $newCampaign, $newAdvGroup, $newAdv)
    {
        for($i = 0; $i < $this->numBanners; $i++) {
            $newBannerModel = new Banner;
            $newBannerModel->fill([
                'adv_id' => $newAdv->id,
                'title' => 'Banner example for adv ' . $newAdv->id,
                'description' => 'Banner example description for adv id = ['.$newAdv->id.'], advgroup id = ['.$newAdvGroup->id.'], campaign id = ['.$newCampaign->id.'], project id = ['.$newProject->id.'], for user №'.$newUser->id,
                'path' => [
                    '0ca88d976c4a0333bddbe69433dafec9.jpg',
                    'e49c942c9427dc5a2de2ec1d5b6cbdee.jpg',
                    '070c24ff31f674876b702c2c6f08d0cf.png',
                    '6d6a0ddbcef1e9e9722d6e3509096e6d.jpg'
                ][(new \App\Components\RandomGenerator(0, 3))->getRandomNumber()],
                'user_id' => $newUser->id
            ]);

            $newBannerModel->save();
        }
    }

    /**
     * Generate advs
     *
     * @param $newUser
     * @param $newProject
     * @param $newCampaign
     * @param $newAdvGroup
     */
    private function _generateAdvs($newUser, $newProject, $newCampaign, $newAdvGroup) {
        $generator = new \App\Components\RandomGenerator(100, 10000);
        $faker = Faker\Factory::create();

        for($i = 0; $i < $this->numAdvs; $i++) {
            $numShows =  $generator->getRandomNumber();
            $numClicks = $numShows - ($numShows - floor($numShows / 3));

            $newAdv = new Adv();
            $newAdv->name = 'Dummy name';
            $newAdv->text = 'Dummy text';
            $newAdv->title = 'Dummy title';
            $newAdv->user_id = $newUser->id;
            $newAdv->campaign_id = $newCampaign->id;
            $newAdv->budget = 100;
            $newAdv->daily_budget = 25;
            $newAdv->num_shows = $numShows;
            $newAdv->num_clicks = $numClicks;
            $newAdv->campaign_id = $newCampaign->id;
            $newAdv->adv_group_id = $newAdvGroup->id;
            $newAdv->user_id = $newUser->id;
            $newAdv->url = $faker->url;
            $newAdv->is_dummy = 1;
            $newAdv->save();

            $newAdv->name = 'Adv id = ['.$newAdv->id.'],  for user №'.$newUser->id;
            $newAdv->text = 'Adv id = ['.$newAdv->id.'], advgroup id = ['.$newAdvGroup->id.'], campaign id = ['.$newCampaign->id.'], project id = ['.$newProject->id.'], for user №'.$newUser->id;
            $newAdv->title = 'Title for adv #';
            $newAdv->save();

            DB::connection('mysql-backoffice')->table('advs_types-advs')->insert([
                'adv_id' => $newAdv->id,
                'adv_type_id' => 1
            ]);

            $this->_generateBanners($newUser, $newProject, $newCampaign, $newAdvGroup, $newAdv);
        }
    }



    /**
     * Generate adv groups
     *
     * @param $newUser
     * @param $newProject
     * @param $newCampaign
     */
    private function _generateAdvGroups($newUser, $newProject, $newCampaign) {
        for($i = 0; $i < $this->numAdvGroups; $i++) {
            $newAdvGroup = new AdvGroup();
            $newAdvGroup->name = 'AdvGroup №'.$i.' for user №'.$newUser->id;
            $newAdvGroup->user_id = $newUser->id;
            $newAdvGroup->campaign_id = $newCampaign->id;
            $newAdvGroup->budget = 2500;
            $newAdvGroup->daily_budget = 250;
            $newAdvGroup->click_price = 2;

            $newAdvGroup->save();

            $this->_generateAdvs($newUser, $newProject, $newCampaign, $newAdvGroup);
        }
    }


    /**
     * Generate campaigns
     *
     * @param $newUser
     * @param $newProject
     */
    private function _generateCampaigns($newUser, $newProject) {
        for($i = 0; $i < $this->numCampaigns; $i++) {
            $newCampaign = new Campaign();
            $newCampaign->name = 'Campaign №'.$i.' for user №'.$newUser->id;
            $newCampaign->user_id = $newUser->id;
            $newCampaign->date_from = Carbon::now()->subDays(10);
            $newCampaign->date_to = Carbon::now()->subDays(-10);
            $newCampaign->project_id = $newProject->id;
            $newCampaign->budget = 5000;
            $newCampaign->daily_budget = 500;

            $newCampaign->save();

            $this->_generateAdvGroups($newUser, $newProject, $newCampaign);
        }
    }

    /**
     * Generate projects
     *
     * @param $newUser
     */
    private function _generateProjects($newUser) {
        for($i = 0; $i < $this->numProjects; $i++) {

            $newProject = new Project();
            $newProject->name = 'Project №'.$i.' for user №'.$newUser->id;
            $newProject->user_id = $newUser->id;
            $newProject->budget = 10000;
            $newProject->daily_budget = 1000;
            $newProject->save();

            $this->_generateCampaigns($newUser, $newProject);
        }

    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for($i = 0; $i < $this->numUsers; $i++) {
            do {
                $firstName = $this->firstNames[rand(0, count($this->firstNames) - 1)];
                $lastName = $this->lastNames[rand(0, count($this->lastNames) - 1)];
            } while(User::where('email', strtolower($firstName.'_'.$lastName.'@testmail.com'))->count() > 0);

            $newUser = new User;
            $newUser->email = strtolower($firstName.'_'.$lastName.'@testmail.com');
            $newUser->password = 123456;
            $newUser->first_name = $firstName;
            $newUser->last_name = $lastName;
            $newUser->api_key = (new \App\Components\ApiCounter())->generateApiKey();
            $newUser->save();

            $this->_generateProjects($newUser);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
