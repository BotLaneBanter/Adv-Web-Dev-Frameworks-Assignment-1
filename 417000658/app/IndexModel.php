<?php 

class IndexModel extends Observable_Model{

    public function getAll() : array {

        //Get all contents of courses.json file
        $coursesData = $this->loadData(DATA_DIR . '/courses.json');

        //Get the most popular and most favourite courses
        $popularColumn = array_column($coursesData['courses'], 3);
        $recommendedColumn = array_column($coursesData['courses'], 2);
        //Courses data
        $extra = $coursesData['courses'];


        //Sort data based on recommended
        array_multisort($recommendedColumn, SORT_DESC, $coursesData['courses']);
        //Return values from coursesData from position 0 to 8
        $recommendedCourses = array_slice($coursesData['courses'], 0, 8);
        //Sort based on recommended
        array_multisort($popularColumn, SORT_DESC, $coursesData['courses']);
        //Return values from extra from position 0 to 8
        $popularCourses = array_slice($extra, 0, 8);

        //Return an associative multidimensional array of popular and recommended courses
        return ['popular' => $popularCourses, 'recommended' => $recommendedCourses];

    }

    public function getRecord(string $id) : array {

        return [];

    }

}

?>