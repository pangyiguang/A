<?php
$url = 'http://www.hao123.com/gaoxiao/screen/all/1';
$content = Http::curl($url, 'get', array());
if (!$content) {
    exit('no data');
}
if (!$content['body']) {
    exit('no data2');
}
$content = json_decode($content['body'], 1);
if (!$content) {
    exit('no data3');
}

foreach ($content as $value) {
    if (DB::select('select 1 from gaoxiaotu where o_id=? limit 1', array((int) $value['id']))) {
        continue;
    }
    $tmp = Http::curl($value['picurl'][0]['picurl'], 'get', array());
    $tmp2 = Http::curl($value['picurl'][212]['picurl'], 'get', array());
    if (!$tmp || !$tmp['body']) {
        echo $value['id'] . '图片内容获取失败<br />';
        continue;
    }
    if (!$tmp2) {
        $tmp2 = $tmp;
    }
    $md5 = md5($value['picurl'][0]['picurl']);
    $file1 = UPLOAD_ROOT . '/gaoxiao/orig/' . substr($md5, 0, 2) . '/' . $md5;
    $file2 = UPLOAD_ROOT . '/gaoxiao/small/' . substr($md5, 0, 2) . '/' . $md5;
    if (Common::createDir($file1, 1) && !file_put_contents($file1, $tmp['body'])) {
        continue;
    }
    if (Common::createDir($file2, 1) && !file_put_contents($file2, $tmp2['body'])) {
        continue;
    }
    $insert = array(
        'o_id' => (int) $value['id'],
        'site_id' => $value['site_id'] == '9999' ? 99 : (int) $value['site_id'],
        'site_link' => $value['from']['link'] ? $value['from']['link'] : '',
        'site_title' => $value['from']['title'] ? $value['from']['title'] : '',
        'title' => trim($value['title']),
        'content' => trim($value['content']),
        'tags' => str_replace('|', ' ', $value['ctg']),
        'tags_index' => String::to_full_index_str(str_replace('|', ' ', $value['ctg'])),
        'linkurl' => trim($value['linkurl']),
        'picurl' => str_replace(array(UPLOAD_ROOT, '\\' . '/\\'), array('http://m.pangyiguang.com/upload', '/', '/'), $file2),
        'picurl_orig' => str_replace(array(UPLOAD_ROOT, '\\' . '/\\'), array('http://m.pangyiguang.com/upload', '/', '/'), $file1),
        'create_at' => (int) $value['create_at'],
        'vote_up' => (int) $value['vote_up'],
        'vote_down' => (int) $value['vote_down'],
        'share' => (int) $value['share'],
        'addtime' => TIME_SATMP,
    );
    if (DB::insert('gaoxiaotu', $insert)) {
        echo $value['id'] . '插入成功'."\n";
    } else {
        echo $value['id'] . '插入失败'."\n";
    }
}