<?php namespace App\CI\Helpers;

class DistanceHelper
{




    public function transformPrefs($prefs){
        $results = [];

        foreach($prefs as $person => $items){
            foreach($items as $item => $rating){
                # Обменять местами человека и предмет
                $results[$item][$person] = $rating;
            }
        }

        return $results;
    }

    /**
     * Получить рекомендации для заданного человека, пользуясь взвешенным средним
     * оценок, данных всеми остальными пользователями
     */
    public function getRecommendations($prefs,$person,$similarity='sim_pearson'){

        $totals = [];
        $simSums = [];


        foreach($prefs as $otherPerson=>$items){
            // сравнивать меня с собой же не нужно
            if($otherPerson == $person)
                continue;

            $sim = $this->$similarity($prefs, $person, $otherPerson);

            // игнорировать нулевые и отрицательные оценки
            if($sim <= 0)
                continue;

            foreach($prefs[$otherPerson] as $item=>$rating){

                // оценивать только фильмы, которые я еще не смотрел
                if( ! array_key_exists($item, $prefs[$person]) || $prefs[$person][$item] == 0.0){
                    // Коэффициент подобия * Оценка
                    if( ! isset($totals[$item])) $totals[$item] = 0;
                    //totals[item]+=prefs[other][item]*sim
                    $totals[$item] += $rating * $sim;

                    // Сумма коэффициентов подобия
                    if( ! isset($simSums[$item])) $simSums[$item] = 0;
                    $simSums[$item]+=$sim;
                }
            }
        }

        // Создать нормализованный список
        foreach($totals as $item=>$total){
            $rankings[$item] = $total / $simSums[$item];

        }

        arsort($rankings);

        return $rankings;
    }

    /**
     * Возвращает список наилучших соответствий для человека из словаря prefs.
     * Количество результатов в списке и функция подобия – необязательные
     * параметры.
     */
    public function topMatches($prefs, $person, $n=5, $similarity = 'sim_pearson'){

        $topMatches = [];

        foreach($prefs as $person_item=>$items){

            if($person_item == $person)
                continue;

            $topMatches[$person_item] = $this->$similarity($prefs, $person, $person_item);
        }

        // отсортировать список по убыванию оценок

        arsort($topMatches);

        return array_slice($topMatches, 0, $n);
    }


    /**
     * Возвращает оценку подобия person1 и person2 на основе расстояния
     *
     * @param $prefs
     * @param $person1
     * @param $person2
     */
    public function sim_distance($prefs,$person1,$person2)
    {
        $si = [];

        $sum_of_squares = 0;

        foreach($prefs[$person1] as $item=>$rating){
            if(array_key_exists($item, $prefs[$person2])){
                $si[$item]=1;

                # Сложить квадраты разностей
                $sum_of_squares += pow($rating - $prefs[$person2][$item], 2);
            }
        }

        # Если нет ни одной общей оценки, вернуть 0
        if(count($si)==0)
            return 0.0;



        return 1/(1+$sum_of_squares);
    }


    /**
     * Возвращает коэффициент корреляции Пирсона между p1 и p2
     *
     * @param $prefs
     * @param $p1
     * @param $p2
     */
    public function sim_pearson($prefs,$p1,$p2){

        // Получить список предметов, оцененных обоими
        $si = [];

        foreach($prefs[$p1] as $item=>$rating){
            if(array_key_exists($item, $prefs[$p2])){
                $si[$item]=1;
            }
        }

        // Найти число элементов
        $n=count($si);

        // Если нет ни одной общей оценки, вернуть 0
        if ($n==0) return 0;

        // Вычислить сумму всех предпочтений
        $sum1 = 0;
        $sum2 = 0;
        foreach($si as $item=>$value){
            $sum1 += $prefs[$p1][$item];
            $sum2 += $prefs[$p2][$item];
        }

        //Вычислить сумму квадратов
        $sum1Sq = 0;
        $sum2Sq = 0;
        foreach($si as $item=>$value){
            $sum1Sq += pow($prefs[$p1][$item], 2);
            $sum2Sq += pow($prefs[$p2][$item], 2);
        }

        // Вычислить сумму произведений
        $pSum = 0;
        foreach($si as $item=>$value){
            $pSum += $prefs[$p1][$item]*$prefs[$p2][$item];
        }

        // Вычислить коэффициент Пирсона
        $num=$pSum-($sum1*$sum2/$n);
        $den=sqrt(($sum1Sq-pow($sum1,2)/$n)*($sum2Sq-pow($sum2,2)/$n));
        if ($den==0) return 0;

        $r=$num/$den;
        return $r;

    }
}