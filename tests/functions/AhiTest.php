<?php

namespace zonuexe\Zonufuck\functions;

use function zonuexe\Zonufuck\gen;
use function zonuexe\Zonufuck\stream_for;
use function zonuexe\Zonufuck\strip_line_comment;

/**
 * Test case for function zonuexe\Zonufuck\gen()
 *
 * This test cases are based kinaba's brainfuck article that licensed under NYSL.
 *
 * @see http://www.kmonos.net/alang/etc/brainfuck.php
 * @copyright 2019 zonuexe
 * @author USAMI Kenta <tadsan@zonu.me>
 * @license GPL-3.0-or-later
 */
class AhiTest extends \zonuexe\Zonufuck\TestCase
{
    private const BF_TOKENS = [
        'inc' => 'おい！',
        'dec' => '！いお',
        'nxt' => 'ｻｲｺｯ',
        'prv' => '<',
        'opn' => 'ﾔﾙﾈｪ',
        'cls' => 'ﾅﾙﾎﾄﾞﾈｪ',
        'put' => 'ｿﾕｺﾄｯ',
        'get' => 'ﾊﾊ~ﾝ',
    ];


    /**
     * @dataProvider for_test
     */
    public function test(string $expected, string $code, string $input = '')
    {
        $output_resource = stream_for('', 'rw');
        $input_resource = stream_for($input, 'rw');

        $code = strip_line_comment('#', $code);

        $bf = gen(self::BF_TOKENS);
        $bf($code, $input_resource, $output_resource);

        \rewind($output_resource);

        $this->assertEquals($expected, \stream_get_contents($output_resource));
    }

    public function for_test()
    {
        yield 'matsuahi' => [
            'Hello World!' . PHP_EOL,
            'ｻｲｺｯおい！おい！おい！おい！おい！おい！おい！おい！おい！ﾔﾙﾈｪ…<おい！おい！おい！おい！おい！おい！おい！おい！ｻｲｺｯ！いおﾅﾙﾎﾄﾞﾈｪ…<ｿﾕｺﾄｯｻｲｺｯおい！おい！おい！おい！おい！おい！おい！ﾔﾙﾈｪ…<おい！おい！おい！おい！ｻｲｺｯ！いおﾅﾙﾎﾄﾞﾈｪ…<おい！ｿﾕｺﾄｯおい！おい！おい！おい！おい！おい！おい！ｿﾕｺﾄｯｿﾕｺﾄｯおい！おい！おい！ｿﾕｺﾄｯﾔﾙﾈｪ…！いおﾅﾙﾎﾄﾞﾈｪ…ｻｲｺｯおい！おい！おい！おい！おい！おい！おい！おい！ﾔﾙﾈｪ…<おい！おい！
おい！おい！ｻｲｺｯ！いおﾅﾙﾎﾄﾞﾈｪ…<ｿﾕｺﾄｯｻｲｺｯおい！おい！おい！おい！おい！おい！おい！おい！おい！おい！おい！ﾔﾙﾈｪ…<おい！おい！おい！おい！おい！ｻｲｺｯ！いおﾅﾙﾎﾄﾞﾈｪ…<ｿﾕｺﾄｯｻｲｺｯおい！おい！おい！おい！おい！おい！おい！おい！ﾔﾙﾈｪ…<おい！おい！おい！ｻｲｺｯ！いおﾅﾙﾎﾄﾞﾈｪ…<ｿﾕｺﾄｯおい！おい！おい！ｿﾕｺﾄｯ！いお！いお！いお！いお！いお！いおｿﾕｺﾄｯ！いお！いお！いお！いお！いお！いお！いお！いおｿﾕｺﾄｯﾔﾙﾈｪ…！いおﾅﾙﾎﾄﾞﾈｪ…ｻｲｺｯ
おい！おい！おい！おい！おい！おい！おい！おい！ﾔﾙﾈｪ…<おい！おい！おい！おい！ｻｲｺｯ！いおﾅﾙﾎﾄﾞﾈｪ…<おい！ｿﾕｺﾄｯﾔﾙﾈｪ…！いおﾅﾙﾎﾄﾞﾈｪ…おい！おい！おい！おい！おい！おい！おい！おい！おい！おい！！！！！！ｿﾕｺﾄｯ'
        ];
    }
}
