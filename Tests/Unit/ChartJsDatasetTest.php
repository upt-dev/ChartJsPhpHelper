<?php 

use YusrilHs\ChartJsHelper\ChartJsHelper;

class ChartJsDatasetTest extends PHPUnit_Framework_TestCase {

    public function testGetLabel() {
        $chart = ChartJsHelper::createChart('line');
        $dataset = $chart->createDataset('data_january', 'January');
        $this->assertEquals($dataset->getLabel(), 'January');
    }

    public function testSetProperty() {
        $chart = ChartJsHelper::createChart('line');
        $dataset = $chart->createDataset('data_january', 'January');
        $dataset->setProperty('backgroundColor', 'rgba(0,0,0,.4)');
        $this->assertEquals($dataset->getProperties(), array('backgroundColor'=> 'rgba(0,0,0,.4)'));
        $dataset->setProperty('borderColor', 'rgba(0,0,0,.8)');
        $this->assertEquals($dataset->getProperties(), 
                array(
                        'backgroundColor' => 'rgba(0,0,0,.4)', 
                        'borderColor' => 'rgba(0,0,0,.8)'
                    )
        );
        $dataset->setProperty('backgroundColor', 'rgba(0,0,0,.5)');
        $this->assertEquals($dataset->getProperties(), 
                array(
                        'backgroundColor' => 'rgba(0,0,0,.5)', 
                        'borderColor' => 'rgba(0,0,0,.8)'
                    )
        );

        $this->expectException('InvalidArgumentException');
        $dataset->setProperty('data', array(1,2));
    }

    public function testSetProperties() {
        $chart = ChartJsHelper::createChart('line');
        $dataset = $chart->createDataset('data_january', 'January');
        $dataset->setProperties(array(
                        'backgroundColor' => 'rgba(0,0,0,.4)', 
                        'borderColor' => 'rgba(0,0,0,.8)'
                    ));
        $this->assertEquals($dataset->getProperties(), 
                array(
                        'backgroundColor' => 'rgba(0,0,0,.4)', 
                        'borderColor' => 'rgba(0,0,0,.8)'
                    )
        );
        $dataset->setProperties(array(
                        'backgroundColor' => 'rgba(0,0,0,.4)'
                    ));
        $this->assertEquals($dataset->getProperties(), 
                array(
                        'backgroundColor' => 'rgba(0,0,0,.4)'
                    )
        );
    }

    public function testSetPropertiesUsingSequenceArray() {
        $chart = ChartJsHelper::createChart('line');
        $dataset = $chart->createDataset('data_january', 'January');
        $this->expectException('InvalidArgumentException');
        $dataset->setProperties(array(
            array(
                    'backgroundColor' => 'rgba(0,0,0,.4)', 
                    'borderColor' => 'rgba(0,0,0,.8)'
                )
        ));   
    }

    public function testSetPropertiesWithDataAndLabel() {
        $chart = ChartJsHelper::createChart('line');
        $dataset = $chart->createDataset('data_january', 'January');
        $this->expectException('InvalidArgumentException');
        $dataset->setProperties(array(
            'backgroundColor' => 'rgba(0,0,0,.4)', 
            'borderColor' => 'rgba(0,0,0,.8)',
            'label'=>'January',
            'data'=> array(0,1)
        ));   
    }

}
