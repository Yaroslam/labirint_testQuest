<?php

class Life {
    public $grid = [];


    public function generateGrid($heigh, $widt){
        for ($i = 1; $i <= $widt; $i++) {
            $height = [];
            for ($j = 1; $j <= $heigh; $j++) {
                $height[$j] = round(rand(0,1));
            }
            $this->grid[$i] = $height;
        }
    }



    public function run() {
        $newGrid = [];

        foreach ($this->grid as $widthId => $width) {
            $newGrid[$widthId] = [];
            foreach ($width as $heightId => $height) {
                $count = $this->countNeighborhoodCells($widthId, $heightId);
                if ($height == 1) {
                    if ($count < 2 || $count > 3) {
                        $height = 0;
                    }
                    else {
                        $height = 1;
                    }
                }
                else {
                    if ($count == 3) {
                        $height = 1;
                    }
                }

                $newGrid[$widthId][$heightId] = $height;
            }
        }
        $this->grid = $newGrid;
        unset($newGrid);
    }


    public function countNeighborhoodCells($x, $y) {
        $neighborhoodArray = [
            [-1, -1],[-1, 0],[-1, 1],
            [0, -1],[0, 1],
            [1, -1],[1, 0],[1, 1]
        ];

        $count = 0;

        foreach ($neighborhoodArray as $neighborhood) {
            if (isset($this->grid[$x + $neighborhood[0]][$y + $neighborhood[1]])
                && $this->grid[$x + $neighborhood[0]][$y + $neighborhood[1]] == 1) {
                $count++;
            }
        }
        return $count;
    }

}

function render(Life $life) {
    $output = '';
    $alive = 0;
    foreach ($life->grid as $widthId => $width) {
        foreach ($width as $heightId => $height) {
            if ($height == 1) {
                $output .= '*';
                $alive++;
            } else {
                $output .= '.';
            }
        }
        $output .= PHP_EOL;
    }
    $output .= '--------------------------------------------'.PHP_EOL;
    return [$output, $alive];
}

$life = new Life();
$life->generateGrid(10,10);

while (render($life)[1]>0) {
    echo render($life)[0];
    $life->run();
    usleep(100000);
}

echo render($life)[0];