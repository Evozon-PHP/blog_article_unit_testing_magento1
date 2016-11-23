<?php


class Evo_ProductNotes_Test_Model_NoteTest extends EcomDev_PHPUnit_Test_Case
{

    /**
     * @test
     * @dataProvider dataProvider
     */
    public function setNoteThenGetNoteHtml($rawContent, $expectation)
    {
        $note = Mage::getModel('evo_productnotes/note');
        $note->setNote($rawContent);
        $actualContent = $note->getNoteHtml();

        $expectedContent = $this->expected($expectation)->getExpectedContent();
        $this->assertEquals($expectedContent, $actualContent);
    }

    /**
     * @test
     * @dataProvider dataProvider
     */
    public function setNoteFails($rawNote, $exceptionExpected, $maxNoteLength = 0)
    {

        // Mock a note model instance
        $noteModelMock = $this->getModelMock('evo_productnotes/note', ['getMaxNoteLength']);
        $noteModelMock->expects($this->any())->method('getMaxNoteLength')->willReturn($maxNoteLength);

        // Setup the expected exception
        $this->setExpectedException($exceptionExpected['type'], $exceptionExpected['message'], $exceptionExpected['code']);

        // Call tested methoda
        $noteModelMock->setNote($rawNote);

    }
    

    /*
     * Alternative way to test flows : use @depends
     */

    /**
     * @return Evo_ProductNotes_Model_Note
     */
    public function testSetNote()
    {
        $noteContent="<p>This is the note content</p>\nThis <b>is</b> the second line";
        $note = Mage::getModel('evo_productnotes/note');
        $note->setNote($noteContent);
        return $note;

    }

    /**
     * @param Evo_ProductNotes_Model_Note $note
     *
     * @depends testSetNote
     */
    public function testGetNoteHtml($note)
    {
        $expectedContent = "This is the note content<br />\nThis is the second line";
        // Call tested method
        $actualContent = $note->getNoteHtml();
        // Do the equality assertion
        $this->assertEquals($expectedContent, $actualContent);
    }
}