<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

$includeList=array(
    'Interfaces/Http/Request',
    'Http/Request',
    'Routing/Manager',

);

foreach($includeList as $className){
    require_once __DIR__.'/../../../src/'.$className.'.php';
}

final class ManagerTest extends TestCase
{
    public function testAdd(): void
    {
        $request=$this->createMock('Nutshell\Interfaces\Http\Request');
        $request->method('getUrl')->willReturn('/');
        $request->method('getMethod')->willReturn('GET');

        $routingManager=new Nutshell\Routing\Manager($request);
        $routingManager->add('GET','#/#',function(){return 'test';});

        $output=$routingManager->process();

        $this->assertEquals(
            'test',
            $output
        );
    }

}