<?php

class Evo_ProductNotes_Test_Helper_DataTest extends EcomDev_PHPUnit_Test_Case
{

    /**
     * Tests that the helper function obtains the current product the right way (at least for now).
     */
    public function testGetCurrentProduct()
    {
        // Prepare empty model in registry
        $product = Mage::getModel('catalog/product');
        Mage::register('current_product', $product);

        // Call tested method to test that returns from registry
        $helper = Mage::helper('evo_productnotes');
        $current = $helper->getCurrentProduct();

        // Assert the returned model object is the same with the one prepared
        $this->assertSame($product, $current);

    }

    /**
     * Tests that the helper uses 'core/data' model (for now) and calls the model's method properly.
     */
    public function testGetCurrentDatetimeMysqlFormatted()
    {
        // Test data
        $mysqlDatetimeFormat = 'Y-m-d H:i:s';
        $expectedDatetime = '2016-08-30 10:00:00';

        // We have to mock the 'core/date' model because we need to return a current datetime that we control
        $dateModel = $this->getModelMock('core/date', ['date']);
        $dateModel->expects($this->once())
            ->method('date')->with($mysqlDatetimeFormat)
            ->willReturn($expectedDatetime);

        // Replace model that Mage:getModel() returns for 'core/date' with our mock
        $this->replaceByMock('model', 'core/date', $dateModel);

        // Call tested method
        $helper = Mage::helper('evo_productnotes');
        $actualDatetime = $helper->getCurrentDatetimeMysqlFormatted();

        $this->assertEquals($expectedDatetime, $actualDatetime);
    }
}