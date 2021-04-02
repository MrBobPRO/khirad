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

        $names = ['Admin', 'Maestro Magic', 'Ботан 001', 'Александр Чумаков', 'Фарида'];
        $emails = ['admin@mail.ru', 'maestro@mail.ru', 'botan@mail.ru', 'alex@mail.ru', 'fasadulloeva@gmail.com'];

        for($i =0; $i<count($names); $i++) {
            $user = new User;
            if($i == 0) $user->isAdmin = true;
            else $user->isAdmin = false;
            $user->name = $names[$i];
            if($i == 0) $user->password = bcrypt('kn12345');
            else $user->password = bcrypt('12345');
            $user->email = $emails[$i];
            $user->save();
        }


        // AUTHORS
        $authors = ['Абдулҳафиз Қодирӣ', 'Ю. Аҳмадзода', 'Шарифи Маҳмадёр', 'Ҳайдар Алиев', 'Дилафрӯз Қурбонӣ', 'Диловари Мирзо', 'Гулназар', 'Бобораҷаби Сабурӣ', 'Субҳон Ҳабибулло', 'Фарангис Шарифова', 'Фарзона', 'Аброр Зоҳир', 'А Чароғабдол', 'Зулфия Атоӣ', 'Гёте И.В.', 'Баҳманёр Сармаддеҳ', 'Ҷахони Азонзод', 'Шаҳло', 'Ҳоҷи Содиқ', 'Ҳамроҳ Усмон'];

        for($i = 0; $i < count($authors); $i++)
        {
            $author = new Author;
            $author->name = $authors[$i];
            $author->photo = ($i+1) . '.jpg';
            if(($i+1) % 2 == 0) $author->isPopular = true;
            $author->description = 'Абуабдулло Рудаки родился в середине IX в. в селе Пандж Руд (вблизи Пенджикента) в крестьянской семье. О жизни этого замечательного поэта, и особенно о его детстве, сохранилось очень мало данных.<br><br>
            Рудаки в юности стал популярен благодаря своему прекрасному голосу, поэтическому таланту и мастерской игре на музыкальном инструменте руде. Он был приглашен Насром II ибн Ахмадом Саманидом (914-943 гг.) ко двору, где и прошла большая часть жизни. Как говорит Абу-л-Фазл Балами, «Рудаки в свое время был первым среди своих современников в области стихотворства, и ни у арабов, ни у персов нет ему подобного»; он считался не только мастером стиха, но и прекрасным исполнителем, музыкантом, певцом.';
            $author->save();
        }

        $books = ['Дар олами афсона', 'Чор дарвеш', 'Шамоли саҳфагардон', 'Шахсият ва замон', 'Китоби орзуҳо', 'Хунёгар', 'Туву хубиву раънои', 'Ибтидо', 'Кӯҳи абр', 'Таҳаввули ҷумлаи содаи забони тоҷикӣ', 'Дарёи сузон', 'Бозгашт', 'Сабоҳи мардон', 'Девони зулф', 'Девони ғарбӣ-шарқӣ', 'Шоҳаншоҳ', 'Витаминҳо', 'Тифлаки анбарсиришт', 'Тӯй болои тӯй', 'Ҳисори нанг'];

        $prices = ['24', '38.5', '15', '0', '30', '72', '42.5', '0', '12.5', '80', '77.5', '0', '12', '7', '3', '0', '56', '32', '5', '0'];
        $discountPrices = ['0', '32.5', '0', '0', '25.5', '60', '0', '0', '0', '0', '70', '0', '10', '0', '0', '0', '0', '30', '2', '0'];

        $txtColor = ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#000', '#fff', '#fff'];
        $btnColor = ['#342578', '#342578', '#309a1a', '#342578', '#342578', '#905612', '#342578', '#342578', '#000', '#342578', '#342578', '#406693', '#342578', '#342578', '#13226b', '#342578', '#342578', '#000', '#342578', '#342578'];
        $bgColor = ['#342578', '#342578', '#309a1a', '#342578', '#342578', '#905612', '#342578', '#342578', '#9a3f2a', '#342578', '#342578', '#406693', '#342578', '#342578', '#13226b', '#342578', '#342578', '#F1EE9D', '#342578', '#342578'];

        for($i = 0; $i < count($books); $i++)
        {
            $book = new Book;
            $book->name = $books[$i];
            $book->isFree = false;
            $book->price = $prices[$i];
            $book->discountPrice = $discountPrices[$i];
            if(($i+1) % 4 == 0) $book->isFree = true;
            $book->description = 'Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесена типографским или рукописным способом текстовая и графическая (иллюстрации) информация, имеющее, как правило, твёрдый переплёт';
            $book->photo = ($i+1) . '.jpg';
            $book->filename = ($i+1) . '.pdf';
            $book->publisher = 'ООО Ориёнфарм';
            $book->year = rand(1990, 2021);
            $book->pages = rand(4, 80);
            $book->txtColor = $txtColor[$i];
            $book->btnColor = $btnColor[$i];
            $book->bgColor = $bgColor[$i];
            if(($i+1) % 4 != 0) {
                $book->screenshot1 = '1a.jpg';
                $book->screenshot2 = '1b.jpg';
                $book->screenshot3 = '1c.jpg';
            }
            if(($i+1) % 3 == 0) $book->isPopular = true;
            $book->save();
            $book->categories()->attach(rand(1, 26));
            $book->authors()->attach($i+1);
        }


        //CATEGORIES
        $categories = ['Адабиёт', 'Донишномаҳо', 'Забоншиносӣ', 'Зиндагинома', 'Иқтисодиёт', 'Кӯдакон ва наврасон', 'Луғатнома', 'Мантиқ', 'Педагогика',
        'Президент', 'Равоншиносӣ', 'Риёзӣ', 'Санъати сухан', 'Сиёсат', 'Табиатшиносӣ', 'Тарбиявӣ - ахлоқӣ', 'Ташаккули шахсият', 'Таърих', 'Технологияи иттилоотӣ', 'Тиб', 'Фалсафа', 'Фарҳангшиносӣ', 'Физика', 'Химия', 'Ҳуқуқ', 'Ҷомеашиносӣ'];

        foreach($categories as $cat) {
            Category::create([
                'name' => $cat
            ]);
        }

        $review = new Review;
        $review->user_id = 1;
        $review->book_id = 1;
        $review->mark = 5;
        $review->body = 'Однозначно рекомендую к покупке! Сам сделал ошибку, купив несколько лет назад бюджетные версии романов, теперь те книги придётся или подарить, или продать за бесценок. А этот набор, несомненно, станет украшением любой библиотеки. Если бы мне подарили нечто подобное, я был бы доволен как слон.)';
        $review->save();

        $review = new Review;
        $review->user_id = 2;
        $review->book_id = 1;
        $review->mark = 1;
        $review->body = 'Однозначно НЕ рекомендую к покупке! Фуфло полнейшее! Деньги на ветер... Лучше купить 10 пачек чипсов, чем эту фигню!';
        $review->save();

        $review = new Review;
        $review->user_id = 3;
        $review->book_id = 1;
        $review->mark = 5;
        $review->body = 'Норм книга. Этот набор, несомненно, станет украшением любой библиотеки. Если бы мне подарили нечто подобное, я был бы доволен как слон!';
        $review->save();

        $review = new Review;
        $review->user_id = 4;
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
        $review->user_id = 2;
        $review->book_id = 2;
        $review->mark = 1;
        $review->body = 'Понравилось только облошка. А так самаю худшая книга, которую я когда либо читал. ';
        $review->save();

        $review = new Review;
        $review->user_id = 4;
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
        $review->user_id = 3;
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
        $review->user_id = 1;
        $review->book_id = 18;
        $review->mark = 3;
        $review->body = 'Какой-то очень плохой но очень прикольный отзыв про книгу.';
        $review->save();

        $review = new Review;
        $review->user_id = 5;
        $review->book_id = 18;
        $review->mark = 5;
        $review->body = 'Какой-то очень хороший и очень интересный отзыв про книгу.';
        $review->save();

        $book = Book::find(18);
        $book->marksCount  = 2;
        $book->averageMark = 4;
        $book->marksTemplate = '4';
        $book->save();

        $u = User::first();
        $u->books()->attach(4);
        $u->books()->attach(2);
        $u->books()->attach(9);
        $u->books()->attach(7);

        $u = User::find(5);
        $u->books()->attach(4);
        $u->books()->attach(2);
        $u->books()->attach(9);
        $u->books()->attach(7);

        $book = Book::find(2);
        

    }
}
