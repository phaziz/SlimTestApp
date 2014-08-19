<?php

    class Testdata
    {
        public $TESTDATA = '';

        public function getTestdata()
        {
            $this -> TESTDATA = R::getAll('SELECT * FROM test ORDER BY id ASC;');

            if($this -> TESTDATA)
            {
                return $this -> TESTDATA;    
            }
            else
            {
                return false;
            }
        }
    }