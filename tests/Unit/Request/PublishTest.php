<?php namespace MattyRad\NounProject\Unit\Tests\Request;

use MattyRad\Support;
use MattyRad\NounProject\Request\Publish;
use MattyRad\NounProject\Unit\Tests\RequestTest;
use MattyRad\NounProject;

class PublishTest extends RequestTest
{
    public function uriProvider()
    {
        return [
            [new Publish("1"), '/notify/publish'],
            [new Publish("1", true), '/notify/publish?test=1'],
        ];
    }

    public function testCreateResult_returnsFailureResultForMissingLicensesConsumed()
    {
        $n_request = new Publish("1");

        $result = $n_request->createResult(['missing stuff']);

        $this->assertInstanceOf(Support\Result\Failure::class, $result);
        $this->assertContains('licenses_consumed', $result->getReason());
    }

    public function testCreateResult_returnsFailureResultForMissingResult()
    {
        $n_request = new Publish("1");

        $result = $n_request->createResult(["licenses_consumed" => 1]);

        $this->assertInstanceOf(Support\Result\Failure::class, $result);
        $this->assertContains('result', $result->getReason());
    }

    public function testCreateResult_returnsSuccessResult()
    {
        $n_request = new Publish("1");

        $expectedConsumed = 1;
        $expectedResult = "success";
        $result = $n_request->createResult(["licenses_consumed" => $expectedConsumed, "result"=> $expectedResult]);

        $this->assertInstanceOf(Support\Result\Success::class, $result);
        $this->assertInstanceOf(NounProject\Request\Result\Success\Publish::class, $result);

        $this->assertEquals($expectedConsumed, $result->getPublished()['licenses_consumed']);
        $this->assertEquals($expectedResult,  $result->getPublished()['result']);
    }



}
