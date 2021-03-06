<?php 
use PHPUnit\Framework\TestCase;
use YusrilHs\ChartJsHelper\ChartJsHelper;

class ChartJsLibTest extends TestCase {
    public function testSetLabels() {
        $labels = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $invalidLabels = array(
            '01'=>'January',
            '02'=>'February'
        );

        $chart = ChartjsHelper::createChart('line_set_labels', 'line');
        $chart->setLabels($labels);
        $config = $chart->getConfig();

        // Test using sequence array
        $this->assertEquals(count($labels), count($config['data']['labels']));

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

        $chart = ChartjsHelper::createChart('line_test_set_options', 'line');
        $chart->setOptions($options);
        $config = $chart->getConfig();
        $this->assertEquals($options, $config['options']);
    }

    public function testUseFillZero() {
        $chart = ChartJsHelper::createChart('line_test_use_fill_zero', 'line');
        $labels = array('January', 'February');
        $chart->setLabels($labels);
        $chart->useFillZero();
        $dataset = $chart->createDataset('2017', '2017');
        $this->assertEquals(count($labels), count($dataset->getData()));

        foreach ($dataset->getData() as $value) {
            $this->assertEquals($value, 0);
        }
    }

    public function testUseRainbowColor() {
        $chart = ChartJsHelper::createChart('line_test_use_rainbow_color', 'line');
        $chart->setLabels(array('January', 'February', 'March', 'April'));
        $chart->useFillZero();
        $dataset = $chart->createDataset('2017','2017');
        $dataset->setProperty('backgroundColor', 'rgba(0,0,0,1)');
        $config = $chart->getConfig();

        $this->assertEquals($config['data']['datasets'][0]['backgroundColor'], 'rgba(0,0,0,1)');
        $chart->useRainbowColor();
        $config = $chart->getConfig();
        $this->assertNotEquals($config['data']['datasets'][0]['backgroundColor'], 'rgba(0,0,0,1)');
    }

    public function testCreateDataset() {
        $chart = ChartjsHelper::createChart('line_test_create_dataset', 'line');
        $dataset = $chart->createDataset('2017', '2017');
        $this->assertEquals($chart->hasDataset('2017'), true);
        $this->assertEquals($chart->dataset('2017'), $dataset);

        try {
            $chart->createDataset('2017', '2017');
        } catch(InvalidArgumentException $e) {
            return;
        }

        $this->fail();
    }

    public function testInvalidDataset() {
        $chart = ChartjsHelper::createChart('line_test_invalid_dataset', 'line');
        
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
        $chart = ChartJsHelper::createChart('line_test_get_config', 'line');
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
        $this->assertEquals(count($config['data']['datasets'][0]['data']), 12);
        $this->assertEquals($config['options'], $options);
    }

    public function testGetConfigPieChart() {
        $sampleData = array(
            'Like'=> rand(20, 100),
            'Hate'=> rand(20, 100),
            'Simple'=> rand(20, 100)
        );
        $colorMap = array(
            'Like'=> 'rgba(237,35,73,.6)',
            'Hate'=> 'rgba(56,140,203,.6)',
            'Simple'=> 'rgba(82,203,56,.6)'
        );
        
        $chart = ChartJsHelper::createChart('pie_test_get_config_pie1', 'pie');
        $chart2 = ChartJsHelper::createChart('pie_test_get_config_pie2', 'pie');

        $chart->setLabels(array_keys($sampleData));
        $chart2->setLabels(array_keys($sampleData));
        
        $chart->useFillZero();
        $chart2->useFillZero();
        
        $chart2->useRainbowColor();

        $dataset = $chart->createDataset('vote', 'vote');
        $dataset2 = $chart2->createDataset('vote', 'vote');
        $dataset->setData(array_values($sampleData));
        $dataset2->setData(array_values($sampleData));
        $dataset->setProperties(array('backgroundColor'=> array_values($colorMap)));

        $config = $chart->getConfig();
        $config2 = $chart2->getConfig();

        $this->assertEquals(count($config['data']['datasets'][0]['data']), count($sampleData));
        $this->assertEquals(count($config2['data']['datasets'][0]['data']), count($sampleData));

        $this->assertEquals(count($config['data']['datasets'][0]['backgroundColor']), count($sampleData));
        $this->assertEquals(count($config2['data']['datasets'][0]['backgroundColor']), count($sampleData));
    }

    public function testSetElementId() {
        $chart = ChartjsHelper::createChart('test_set_element_id', 'line');
        $this->assertEquals('canvas', $chart->getElementId());
        $chart->setElementId('line_chart');
        $this->assertEquals('line_chart', $chart->getElementId());
    }
}
