<?php 

use YusrilHs\ChartJsHelper\ChartJsHelper;

class ChartJsLibTest extends PHPUnit_Framework_TestCase {
    public function testSetLabels() {
        $labels = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $invalidLabels = array(
            '01'=>'January',
            '02'=>'February'
        );

        $chart = ChartjsHelper::createChart('line');

        // Test using sequence array
        $chart->setLabels($labels);
        $this->assertEquals(count($labels), count($chart->getLabels()));

        // Test invalid set labels using an associative array
        $this->expectException('InvalidArgumentException');
        $chart->setLabels($invalidLabels);
    }

    public function testSetOptions() {
        $options = array(
            'responsive'=>true,
            'title' => array(
                'display' => true,
                'text' => 'ChartjsHelper'
            ),
            'tooltips'=> array(
                    'mode'=> 'index',
                    'intersect'=> false,
            ),
            'hover'=> array(
                'mode'=> 'nearest',
                'intersect'=> true
            ),
            'scales'=> array(
                'xAxes'=> array(array(
                    'display'=> true,
                    'scaleLabel'=> array(
                        'display'=> true,
                        'labelString'=> 'Month'
                    )
                )),
                'yAxes'=> array(array(
                    'display'=> true,
                    'scaleLabel'=> array(
                        'display'=> true,
                        'labelString'=> 'Value'
                    )
                ))
            )
        );

        $chart = ChartjsHelper::createChart('line');
        $chart->setOptions($options);
        $this->assertEquals($options, $chart->getOptions());
    }

    public function testUseFillZero() {
        $chart = ChartJsHelper::createChart('line');
        $labels = array('January', 'February');
        $chart->setLabels($labels);
        $this->assertEquals($chart->usingFillZero(), false);
        $chart->useFillZero();
        $this->assertEquals($chart->usingFillZero(), true);

        $dataset = $chart->createDataset('2017', '2017');
        $this->assertEquals(count($labels), count($dataset->getData()));

        foreach ($dataset->getData() as $value) {
            $this->assertEquals($value, 0);
        }
    }

    public function testUseRainbowColor() {
        $chart = ChartJsHelper::createChart('line');
        $this->assertEquals($chart->usingRainbowColor(), false);
        $chart->useRainbowColor();
        $this->assertEquals($chart->usingRainbowColor(), true);
    }

    public function testCreateDataset() {
        $chart = ChartjsHelper::createChart('line');
        $dataset = $chart->createDataset('2017', '2017');
        $this->assertEquals($chart->hasDataset('2017'), true);
        $this->assertEquals($chart->dataset('2017'), $dataset);

        $this->expectException('InvalidArgumentException');
        $chart->createDataset('2017', '2017');
    }

    public function testInvalidDataset() {
        $chart = ChartjsHelper::createChart('line');
        
        $this->expectException('InvalidArgumentException');
        $chart->dataset('2018');
    }

    public function testGetConfig() {
        $labels = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $options = array(
            'responsive'=>true,
            'title' => array(
                'display' => true,
                'text' => 'ChartjsHelper'
            ),
            'tooltips'=> array(
                    'mode'=> 'index',
                    'intersect'=> false,
            ),
            'hover'=> array(
                'mode'=> 'nearest',
                'intersect'=> true
            ),
            'scales'=> array(
                'xAxes'=> array(array(
                    'display'=> true,
                    'scaleLabel'=> array(
                        'display'=> true,
                        'labelString'=> 'Month'
                    )
                )),
                'yAxes'=> array(array(
                    'display'=> true,
                    'scaleLabel'=> array(
                        'display'=> true,
                        'labelString'=> 'Value'
                    )
                ))
            )
        );
        $indonesianChartData = array(rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand());
        $englishChartData = array(rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand(), rand());
        $chart = ChartJsHelper::createChart('line');
        $chart->setLabels($labels);
        $chart->setOptions($options);
        $chart->useRainbowColor();
        $indonesianDataset = $chart->createDataset('indonesian', 'Indonesian');
        $englishDataset = $chart->createDataset('english', 'English');

        $indonesianDataset->setData($indonesianChartData);
        $englishDataset->setData($englishChartData);

        $config = $chart->getConfig();
        $this->assertEquals($config['data']['labels'], $labels);
        $this->assertEquals(count($config['data']['datasets']), 2);
        $this->assertEquals($config['options'], $options);
    }
}
