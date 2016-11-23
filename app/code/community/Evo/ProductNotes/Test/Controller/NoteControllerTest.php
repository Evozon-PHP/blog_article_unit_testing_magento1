<?php

require_once 'Evo/ProductNotes/controllers/NoteController.php';

class Evo_ProductNotes_Test_Controller_NoteControllerTest extends EcomDev_PHPUnit_Test_Case_Controller
{

    /**
     * Tests the success flow for the action.
     *
     * @param array $postData
     * @param string $currentDatetime
     * @param string $referer
     *
     * @dataProvider newActionProvider
     */
    public function testNewAction(array $postData, $currentDatetime, $referer)
    {
        // Setup request
        $this->setPostData($postData, $referer);

        // Mock the helper
        $helperMock = $this->getHelperMock('evo_productnotes', array('getCurrentDatetimeMysqlFormatted'));
        $helperMock->expects($this->once())->method('getCurrentDatetimeMysqlFormatted')
            ->willReturn($currentDatetime);
        $this->replaceByMock('helper', 'evo_productnotes', $helperMock);

        // Mock the note model
        $noteMock = $this->getModelMock('evo_productnotes/note',
            array(
                'setProductId',
                'setNote',
                'setNoteDate',
                'save'
            )
        );

        // Set the expectancies regarding the setters of the model and the save method
        $noteMock->expects($this->once())->method('setProductId')->with((int)$postData['product_id']);
        $noteMock->expects($this->once())->method('setNote')->with($postData['note']);
        $noteMock->expects($this->once())->method('setNoteDate')->with($currentDatetime);
        $noteMock->expects($this->once())->method('save');
        $this->replaceByMock('model', 'evo_productnotes/note', $noteMock);

        // Dispatch action
        $this->dispatch('evo_productnotes/note/new');

        // Expect action to redirect to referrer
        $this->assertRedirectToUrl($referer);
        $this->assertResponseHttpCode(302);

    }

    /**
     * Data provider
     * @see testNewAction
     * @return array
     */
    public function newActionProvider()
    {
        return [
            [['product_id' => 1, 'note' => 'some text'], '2016-01-01 10:00:00', Mage::app()->getStore()->getBaseUrl() . '/some-path']
        ];
    }


    /**
     * @param array $postData
     * @param array $exceptionExpected
     *
     * @dataProvider newActionThrowsExceptionProvider
     */
    public function testNewActionThrowsException(array $postData, $exceptionExpected)
    {

        $this->setPostData($postData);

        $this->setExpectedException($exceptionExpected['type'], $exceptionExpected['message'], $exceptionExpected['code']);

        // Dispatch action
        $this->dispatch('evo_productnotes/note/new');
    }

    /**
     * Data provider
     * @see testNewActionThrowsException
     * @return array
     */
    public function newActionThrowsExceptionProvider()
    {
        $typeMissing = 'Evo_ProductNotes_Controller_Exception_MissingParameterException';
        $typeWrong = 'Evo_ProductNotes_Controller_Exception_WrongParameterException';

        $messageMissing = Evo_ProductNotes_Controller_Exception_MissingParameterException::MESSAGE_POST_PARAMETER;
        $messageWrong = Evo_ProductNotes_Controller_Exception_WrongParameterException::MESSAGE_POST_PARAMETER;

        $codeMissing = Evo_ProductNotes_Controller_Exception_MissingParameterException::CODE_POST_PARAMETER;
        $codeWrong = Evo_ProductNotes_Controller_Exception_WrongParameterException::CODE_POST_PARAMETER;

        return [
            [['note' => 'some text'], ['type' => $typeMissing, 'message' => sprintf($messageMissing, 'product_id'), 'code' => $codeMissing]], // missing product_id
            [['product_id' => 'abc', 'note' => 'some text'], ['type' => $typeWrong, 'message' => sprintf($messageWrong, 'product_id'), 'code' => $codeWrong]], // wrong product_id type
            [['product_id' => 1], ['type' => $typeMissing, 'message' => sprintf($messageMissing, 'note'), 'code' => $codeMissing]], // missing note
            [['product_id' => 1, 'note' => ''], ['type' => $typeMissing, 'message' => sprintf($messageMissing, 'note'), 'code' => $codeMissing]], // empty note
        ];
    }

    /**
     * Sets POST data and prepares request object for test case
     * @param array $postData
     * @param string $referrer
     */
    protected function setPostData(array $postData, $referrer = null)
    {
        $request = $this->getRequest();
        $request->setMethod('POST');
        $request->setPost($postData);
        if ($referrer) {
            $request->setParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_REFERER_URL, $referrer);
        }

    }
}