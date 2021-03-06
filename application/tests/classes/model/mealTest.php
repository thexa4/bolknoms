<?php defined('SYSPATH') or die('No direct access allowed!');

class mealTest extends Kohana_UnitTest_TestCase
{
    public function setUp()
    {
        parent::setUp();

        // Clear database
        DB::query(Database::DELETE, 'DELETE FROM meals')->execute();
        DB::query(Database::DELETE, 'DELETE FROM registrations')->execute();
    }

    public function testSavesAValidMeal()
    {
        $count = (int)ORM::factory('meal')->count_all();
        ORM::factory('meal')->values(array('date' => '2020-01-01', 'locked' => '14:00'))->save();
        $this->assertEquals($count+1, (int)ORM::factory('meal')->count_all());
    }

    public function testSavesRegistrations()
    {
        $meal = ORM::factory('meal')->values(array('date' => strftime('%Y-%m-%d'), 'locked' => '14:00'))->save();
        $r1 = ORM::factory('registration')->values(array('name' => 'Jakob','email' => 'jpabuis@gmail.com', 'salt' => '123', 'meal_id' => $meal->pk()))->save();
        $r2 = ORM::factory('registration')->values(array('name' => 'Ruben','email' => 'ruben_m@gmail.com', 'salt' => '123', 'meal_id' => $meal->pk()))->save();
        $this->assertEquals(2, $meal->registrations->count_all());
    }

    /**
     * @expectedException ORM_Validation_Exception
     */
    public function testDoesNotSaveAnInvalidMeal()
    {
        ORM::factory('meal')->save();
    }

    public function testHasDefaultOrdering()
    {
        $yesterday = strftime('%Y-%m-%d', strtotime('yesterday'));
        $today = strftime('%Y-%m-%d', strtotime('today'));
        $tomorrow = strftime('%Y-%m-%d', strtotime('tomorrow'));
        DB::query(Database::INSERT, "INSERT INTO meals (id, date) VALUES ('1', '$tomorrow'), ('2', '$yesterday'), ('3', '$today')")->execute();

        $meals = ORM::factory('meal')->find_all();
        $this->assertEquals(2,$meals->current()->id);
        $meals->next();
        $this->assertEquals(3,$meals->current()->id);
        $meals->next();
        $this->assertEquals(1,$meals->current()->id);
    }

    public function testToStringPrintsDate()
    {
        $meal = ORM::factory('meal',array('date' => '2011-06-05'));
        $this->assertEquals('Zondag 5 juni 2011', (string)$meal);
    }
}