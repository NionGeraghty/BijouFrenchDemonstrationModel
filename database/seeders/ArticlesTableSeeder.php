<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

DB::statement('PRAGMA foreign_keys = OFF;'); // disable FK checks
\App\Models\Cohort::truncate();              // empty the table
DB::statement('PRAGMA foreign_keys = ON;');  // re-enable FK checks

class ArticlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('PRAGMA foreign_keys = OFF;'); // Disable foreign key checks
        \DB::table('articles')->delete();
         DB::statement('PRAGMA foreign_keys = ON;');  // Re-enable foreign key checks
        
        \DB::table('articles')->insert(array (
            0 => 
            array (
                'id' => 1,
            'title' => 'Petit Bijou language summary: September to December 2025 (11 weeks)',
            'text' => '<h3><strong>Petit Bijou language summary: September to December 2025 (11 weeks)</strong></h3><p><em>This is a guide only: plenty of other language will be used during the lessons,  and in the songs, the activity sheets, and the suggestions for further learning.</em></p><p><strong>Greetings &amp; how we are feeling  </strong></p><p><strong>Bonjour </strong>(hello)   <strong>Salut </strong>(hi)   <strong>Au revoir</strong> (goodbye)   <strong>À bientôt</strong> (see you soon)<br><strong>Comment ça va?/Ça va</strong> (how are you/how’s it going)</p><p> <strong>Ça va/Ça va bien </strong>(I’m okay/fine)  <strong>Très bien merci</strong> (very well thanks) <strong>  Ça va mal</strong> (not very good)   <br><strong>Je suis fatigué/fatiguée</strong> (I’m tired)       <strong>Et toi/vous?</strong> (how about you?)</p><p><strong>Topic 1: My family </strong></p><p><strong>Je m’appelle…</strong> (my name is…)   <strong>J’ai 7/8/9 ans</strong> (I’m 7/8/9 years old)</p><p><strong>Maman </strong>(mum)   <strong>Papa </strong>(dad)   <strong>ma soeur</strong> (my sister)   <strong>mon frère</strong> (my brother)</p><p><strong>mon grand-père </strong>(my grandfather) <strong>ma grand-mère</strong> (my grandmother)</p><p><strong>Il s’appelle…</strong> (his name is …)   <strong>Elle s’appelle…</strong> (Her name is…)</p><p><strong>Il/Elle est sympa</strong> (He/She is nice)     <strong>Il/Elle est drôle</strong> (He/She is funny)</p><p> <strong>Il est intelligent</strong> (He is intelligent)   <strong> Elle est intelligente</strong> (She is intelligent)</p><p></p><p><strong>Topic 2: Decorating the Christmas tree</strong></p><p><em>We will be decorating a small foam Christmas tree, and the children will ask for the decorations they would like to put on the tree.</em></p><p><strong>Je décore le sapin </strong>(I’m decorating the Christmas tree)</p><p><strong>Père Noël/Papa Noël </strong>(Father Christmas)</p><p><strong>une étoile </strong>(a star)  <strong>un renne</strong> (a reindeer)  <strong>une boule de Noël </strong>( a bauble)</p><p><strong>je voudrais une boule rouge/jaune</strong> (I’d like a red/yellow bauble)     plus other colours</p><p><strong>la bûche de Noël</strong> (the chocolate yule log)</p><p><strong>Je voudrais une part de bûche de Noël s’il vous plaît</strong> (I’d like a slice of Yule log please)</p><p><strong>Bon appétit</strong> (Enjoy your food)</p><p><strong>Joyeux Noël </strong>(Merry Christmas)   <strong>Bonne année </strong>(Happy new year)</p><p></p><p><strong>Basics</strong></p><p>Colours and numbers</p><p><strong>Songs </strong></p><p>Bonjour Bonjour comment ça va?</p><p>Fais dodo</p><p>Petit Papa Noël</p><p>L’as-Tu Vu ?</p>',
            'slug' => 'Petit Bijou language summary: September to December 2025 (11 weeks)',
                'page_id' => NULL,
                'created_at' => '2025-08-20 13:16:18',
                'updated_at' => '2025-08-20 13:16:18',
            ),
            1 =>
            array (
                'id' => 2,
            'title' => 'About Sue',
            'text' => '<h2 className="pb-5">My Story</h2>
            <p className="pb-5">Bonjour! My name is Sue Backley, and I run <strong>Bijou French</strong>.</p>

            <p className="pb-5">I have always loved France and the French language. As a child I spent many happy holidays in France with my family, and we especially enjoyed our trips to Bordeaux to stay with friends. After studying French with German at university, I moved to Nancy in north-eastern France, where I spent 4 years teaching English to university students. I then lived in Paris for 3 years, where I continued to teach English at the Franco-British Chamber of Commerce. I loved my time in France, absorbing the culture and the language, and I continue to enjoy regular holidays there with my family. </p>

            <p className="pb-5">My professional life has been devoted to teaching. Since moving back to England and doing my teacher training, I have taught French and German in secondary schools and French at primary level. Teaching primary school pupils made me realise how well children respond to a language at a young age. I also witnessed first-hand how my own son (now 20 years old!) absorbed French naturally and with a great deal of enthusiasm and enjoyment when he was a child. With this in mind, I set up a French club for children called <strong>Les Petits Dauphins</strong> in January 2007. Since
              then, I have taught countless children of primary age, in lunchtime and after-school clubs in Abingdon. I have loved every second of it!</p>

            <p className="pb-5">When Covid-19 struck in March 2020, I had no idea that I would be unable to return to work for over 18 months. Once the reality began to sink in, I decided to try to put the time to the best possible use and to produce something positive out of a difficult situation. And so, I am very happy to introduce you to Bijou French, my brand-new French course for primary children. So, what is new? As well as attending weekly face-to-face French classes at school, the children will have access to several new resources on my brand-new Bijou French website (see <Link className="text-blue-600 hover:underline" href="/aboutbijoufrench">About Bijou French</Link> for more information). I believe that, by offering this extra material to supplement the classes, I can offer a complete language learning experience, as well as making it easier for parents to get involved with their child’s learning, if they wish to do so.</p>

            <p className="pb-5">I am really excited to embark on this fresh adventure: I love finding new ways to share my passion for France and the French language, and I very much hope your child will enjoy learning French with Bijou French.</p>

            <p className="pb-5">À bientôt.</p>

            <p className="pb-5">Sue</p>

            <p className="pb-5">October 2022</p>',
            'slug' => 'aboutsue',
                'page_id' => NULL,
                'created_at' => '2025-10-09 11:21:00',
                'updated_at' => '2025-10-09 11:21:00',
            ),
        ));
        
        
    }
}