<?php

require_once '../CFileHelper.php';


class CFileHelperTests extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->filename = 'cfile_test_tmp_' . uniqid();
        $this->filepath = sys_get_temp_dir() . '/' . $this->filename;
        $this->cf = CFileHelper::get($this->filepath);
    }

    public function tearDown() {
        $this->cf->delete();
    }

    public function testTestsDir() {
        $cf = $this->cf;
        $cf->createDir();

        $this->assertTrue($cf->getExists());
        $this->assertEquals($this->filename, $cf->getBasename());
        $this->assertEquals($this->filename, $cf->getFilename());
        $this->assertEquals('', $cf->getExtension());
        $this->assertTrue($cf->getIsDir());
        $this->assertTrue($cf->getIsEmpty());
        $this->assertFalse($cf->getIsFile());
        $this->assertFalse($cf->getIsUploaded());
        $this->assertTrue($cf->getReadable());
        $this->assertTrue($cf->getWriteable());
    }

    public function testDirContentsFiltering() {
        $cf = $this->cf;
        $cf->createDir();

        mkdir($cf->realpath . DIRECTORY_SEPARATOR . 'tst_b');

        $fnames = array(
            'tst_a.txt',
            'tst_b.php',
            'tst_c.jpg',
            'tst_d.php',
            'tst_dd.xls',
            'tst_ddd.xls',
            'tst_dddd.xls',
        );

        foreach ($fnames as $fname) {
            $result = file_put_contents($this->filepath . DIRECTORY_SEPARATOR . $fname, '');
            $this->assertFalse($result===false);
        }

        $this->assertEquals(count($cf->getContents(true)), count($fnames)+1);
        $this->assertEquals(count($cf->getContents(true, 'php')), 2);
        $this->assertEquals(count($cf->getContents(true, 'd.php')), 1);
        $this->assertEquals(count($cf->getContents(true, 'tst_b')), 2);
        $this->assertEquals(count($cf->getContents(true, '~d{3,4}~')), 2);

    }

    public function testToString() {
        $this->assertEquals((string)$this->cf, $this->filepath);
    }

    public function testSetOwner() {
        $cf = $this->cf;
        $cf->create();

        $owner_name = $cf->getOwner();
        $owner_id = $cf->getOwner(False);

        $this->setExpectedException('CFileException');
        $cf->setOwner('nosuchuser123987');

        $this->assertNotEquals($cf->setOwner($owner_name), False);

        $this->setExpectedException('CFileException');
        $cf->setOwner('4567890123');

        $this->setExpectedException('CFileException');
        $cf->setOwner(4567890123);

        $this->assertNotEquals($cf->setOwner($owner_id), False);
    }

    public function testSetOwnerRecursive() {
        $cf = $this->cf;
        $cf->createDir();

        $cf_sub = CFileHelper::get($cf->getRealPath() . '/' . uniqid('sub'));
        $cf_sub->create();

        $owner_name = $cf->getOwner();

        $this->assertNotEquals($cf->setOwner($owner_name, True), False);

        $cf_sub->delete();
    }

    public function testSetGroup() {
        $cf = $this->cf;
        $cf->create();

        $group_name = $cf->getGroup();
        $group_id = $cf->getGroup(False);

        $this->setExpectedException('CFileException');
        $cf->setGroup('nosuchgroup123987');

        $this->assertNotEquals($cf->setGroup($group_name), False);

        $this->setExpectedException('CFileException');
        $cf->setGroup('4567890123');

        $this->setExpectedException('CFileException');
        $cf->setGroup(4567890123);

        $this->assertNotEquals($cf->setGroup($group_id), False);
    }

    public function testSetGroupRecursive() {
        $cf = $this->cf;
        $cf->createDir();

        $cf_sub = CFileHelper::get($cf->getRealPath() . '/' . uniqid('sub'));
        $cf_sub->create();

        $group_name = $cf->getGroup();

        $this->assertNotEquals($cf->setGroup($group_name, True), False);

        $cf_sub->delete();
    }

    public function testSetPermissions() {
        $cf = $this->cf;
        $cf->create();

        $perms = $cf->getPermissions();
        $this->assertNotEquals($cf->setPermissions(770), False);
        $this->assertNotEquals($cf->setPermissions($perms), False);
        $this->assertEquals($cf->getPermissions(), $perms);
    }

    public function testSetPermissionsRecursive() {
        $cf = $this->cf;
        $cf->createDir();

        $cf_sub = CFileHelper::get($cf->getRealPath() . '/' . uniqid('sub'));
        $cf_sub->create();

        $this->assertNotEquals($cf->setPermissions(770, True), False);

        $cf_sub->delete();
    }

}
