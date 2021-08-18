<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use App\Models\Author;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $names = ['Admin', 'Moderator'];
        $emails = ['admin@mail.ru', 'moderator@mail.ru'];

        for($i =0; $i<count($names); $i++) {
            $user = new User;
            $user->name = $names[$i];
            $user->password = bcrypt('kn12345');
            $user->email = $emails[$i];
            $user->save();
        }


        // AUTHORS
        $authors = ['Абдулҳафиз Қодирӣ', 'Ю. Аҳмадзода', 'Шарифи Маҳмадёр', 'Ҳайдар Алиев', 'Дилафрӯз Қурбонӣ', 'Диловари Мирзо', 'Гулназар', 'Бобораҷаби Сабурӣ', 'Субҳон Ҳабибулло', 'Фарангис Шарифова', 'Фарзона', 'Аброр Зоҳир', 'А Чароғабдол', 'Зулфия Атоӣ', 'Гёте И.В.', 'Баҳманёр Сармаддеҳ', 'Ҷахони Азонзод', 'Шаҳло', 'Ҳоҷи Содиқ', 'Ҳамроҳ Усмон'];

        for($i = 0; $i < count($authors); $i++)
        {
            $author = new Author;
            $author->name = $authors[$i];
            $author->latin_name = $this->transliterateIntoLatin($authors[$i]);
            $author->photo = ($i+1) . '.jpg';
            if(($i+1) % 2 == 0) $author->popular = true;
            $author->description = 'Абуабдулло Рудаки родился в середине IX в. в селе Пандж Руд (вблизи Пенджикента) в крестьянской семье. О жизни этого замечательного поэта, и особенно о его детстве, сохранилось очень мало данных.<br><br>
            Рудаки в юности стал популярен благодаря своему прекрасному голосу, поэтическому таланту и мастерской игре на музыкальном инструменте руде. Он был приглашен Насром II ибн Ахмадом Саманидом (914-943 гг.) ко двору, где и прошла большая часть жизни. Как говорит Абу-л-Фазл Балами, «Рудаки в свое время был первым среди своих современников в области стихотворства, и ни у арабов, ни у персов нет ему подобного»; он считался не только мастером стиха, но и прекрасным исполнителем, музыкантом, певцом.';
            $author->save();
        }

        $books = ['Дар олами афсона', 'Чор дарвеш', 'Шамоли саҳфагардон', 'Шахсият ва замон', 'Китоби орзуҳо', 'Хунёгар', 'Туву хубиву раънои', 'Ибтидо', 'Кӯҳи абр', 'Таҳаввули ҷумлаи содаи забони тоҷикӣ', 'Дарёи сузон', 'Бозгашт', 'Сабоҳи мардон', 'Девони зулф', 'Девони ғарбӣ-шарқӣ', 'Шоҳаншоҳ', 'Витаминҳо', 'Тифлаки анбарсиришт', 'Тӯй болои тӯй', 'Ҳисори нанг'];

        $txtColor = ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#000', '#fff', '#fff'];
        $btnColor = ['#342578', '#342578', '#309a1a', '#342578', '#342578', '#905612', '#342578', '#342578', '#000', '#342578', '#342578', '#406693', '#342578', '#342578', '#13226b', '#342578', '#342578', '#000', '#342578', '#342578'];
        $bgColor = ['#342578', '#342578', '#309a1a', '#342578', '#342578', '#905612', '#342578', '#342578', '#9a3f2a', '#342578', '#342578', '#406693', '#342578', '#342578', '#13226b', '#342578', '#342578', '#F1EE9D', '#342578', '#342578'];

        for($i = 0; $i < count($books); $i++)
        {
            $book = new Book;
            $book->name = $books[$i];
            $book->latin_name = $this->transliterateIntoLatin($books[$i]);
            $book->free = true;
            if($i == 0 || $i == 18) {
                $book->free = false;
                $book->price = 45;
            }
            $book->description = 'Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесена типографским или рукописным способом текстовая и графическая (иллюстрации) информация, имеющее, как правило, твёрдый переплёт';
            $book->photo = ($i+1) . '.jpg';
            $book->filename = ($i+1) . '.pdf';
            $book->publisher = 'ООО Ориёнфарм';
            $book->year = rand(1990, 2021);
            $book->pages = rand(4, 80);
            $book->language = 'tj';
            $book->txtColor = $txtColor[$i];
            $book->btnColor = $btnColor[$i];
            $book->bgColor = $bgColor[$i];
            if($i == 0) {
                $book->screenshot1 = '1a.jpg';
                $book->screenshot2 = '1b.jpg';
                $book->screenshot3 = '1c.jpg';
            }
            if($i == 4) {
                $book->screenshot1 = '5a.jpg';
                $book->screenshot2 = '5b.jpg';
                $book->screenshot3 = '5c.jpg';
            }
            if($i == 18) {
                $book->screenshot1 = '19a.jpg';
                $book->screenshot2 = '19b.jpg';
                $book->screenshot3 = '19c.jpg';
            }

            if(($i+1) % 3 == 0) $book->most_readable = true;

            if($i ==7) $book->number_of_readings = 59;
            if($i ==2) $book->number_of_readings = 53;
            if($i ==0) $book->number_of_readings = 44;
            if($i ==5) $book->number_of_readings = 37;
            if($i ==6) $book->number_of_readings = 22;
            if($i ==10) $book->number_of_readings = 18;
            if($i ==7) $book->number_of_readings = 7;
            if($i ==14) $book->number_of_readings = 3;
    
            $book->save();
            $book->categories()->attach(rand(1, 25));
            $book->authors()->attach($i+1);
        }


        //CATEGORIES
        $categories = ['Адабиёт', 'Донишномаҳо', 'Забоншиносӣ', 'Зиндагинома', 'Иқтисодиёт', 'Кӯдакон ва наврасон', 'Луғатнома', 'Мантиқ', 'Педагогика', 'Равоншиносӣ', 'Риёзӣ', 'Санъати сухан', 'Сиёсӣ', 'Табиатшиносӣ', 'Тарбиявӣ - ахлоқӣ', 'Ташаккули шахсият', 'Таърих', 'Технологияи иттилоотӣ', 'Тиб', 'Фалсафа', 'Фарҳангшиносӣ', 'Физика', 'Химия', 'Ҳуқуқ', 'Ҷомеашиносӣ'];

        $dd = 'Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесена типографским или рукописным способом текстовая и графическая (иллюстрации) информация, имеющее, как правило, твёрдый переплёт';

        foreach($categories as $cat) {
            Category::create([
                'name' => $cat,
                'description' => $dd,
                'latin_name' => $this->transliterateIntoLatin($cat)
            ]);
        }

        $review = new Review;
        $review->book_id = 1;
        $review->mark = 5;
        $review->body = 'Однозначно рекомендую к покупке! Сам сделал ошибку, купив несколько лет назад бюджетные версии романов, теперь те книги придётся или подарить, или продать за бесценок. А этот набор, несомненно, станет украшением любой библиотеки. Если бы мне подарили нечто подобное, я был бы доволен как слон.)';
        $review->save();

        $review = new Review;
        $review->book_id = 1;
        $review->mark = 1;
        $review->body = 'Однозначно НЕ рекомендую к покупке! Фуфло полнейшее! Деньги на ветер... Лучше купить 10 пачек чипсов, чем эту фигню!';
        $review->save();

        $review = new Review;
        $review->book_id = 1;
        $review->mark = 5;
        $review->body = 'Норм книга. Этот набор, несомненно, станет украшением любой библиотеки. Если бы мне подарили нечто подобное, я был бы доволен как слон!';
        $review->save();

        $review = new Review;
        $review->book_id = 1;
        $review->mark = 3;
        $review->body = 'Понравилось только облошка. А так самаю худшая книга, которую я когда либо читал. ';
        $review->save();

        $book = Book::find(1);
        $book->marksCount  = 4;
        $book->averageMark = 3.5;
        $book->marksTemplate = '3,5';
        $book->save();

        $review = new Review;
        $review->book_id = 2;
        $review->mark = 1;
        $review->body = 'Понравилось только облошка. А так самаю худшая книга, которую я когда либо читал. ';
        $review->save();

        $review = new Review;
        $review->book_id = 2;
        $review->mark = 5;
        $review->body = 'Держи пятюху брат!';
        $review->save();

        $book = Book::find(2);
        $book->marksCount  = 2;
        $book->averageMark = 3;
        $book->marksTemplate = '3';
        $book->save();

        $review = new Review;
        $review->book_id = 5;
        $review->mark = 5;
        $review->body = 'Какой-то очень хороший и можно сказать очень длинный и скучный отзыв про кнмгу и можно сказать очень длинный и скучный отзыв про кнмгу и можно сказать очень длинный и скучный отзыв про кнмгу и можно сказать очень длинный и скучный отзыв про кнмгу.';
        $review->save();

        $book = Book::find(5);
        $book->marksCount  = 1;
        $book->averageMark = 5;
        $book->marksTemplate = '5';
        $book->save();

        $review = new Review;
        $review->book_id = 18;
        $review->mark = 3;
        $review->body = 'Какой-то очень плохой но очень прикольный отзыв про книгу.';
        $review->save();

        $review = new Review;
        $review->book_id = 18;
        $review->mark = 5;
        $review->body = 'Какой-то очень хороший и очень интересный отзыв про книгу.';
        $review->save();

        $book = Book::find(18);
        $book->marksCount  = 2;
        $book->averageMark = 4;
        $book->marksTemplate = '4';
        $book->save();

    }

    private function transliterateIntoLatin($string)
    {
        $cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', ' ',
            'ӣ', 'ӯ', 'ҳ', 'қ', 'ҷ', 'ғ', 'Ғ', 'Ӣ', 'Ӯ', 'Ҳ', 'Қ', 'Ҷ'
        ];

        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','shb','a','i','y','e','yu','ya',
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','shb','a','i','y','e','yu','ya', '_',
            'i', 'u', 'h', 'q', 'j', 'g', 'g', 'i', 'u', 'h', 'q', 'j'
        ];
        //Trasilate url
        $transilation = str_replace($cyr, $lat, $string);

        //return lowercased url
        return strtolower($transilation);
    }

}
