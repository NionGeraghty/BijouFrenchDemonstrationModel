<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('articles')->delete();
        
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
        ));
        
        
    }
}