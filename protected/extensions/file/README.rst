ist-yii-cfile
=============
http://github.com/idlesign/ist-yii-cfile


What's that
-----------

ist-yii-cfile is an extension for Yii Framework, bundling commonly used functions for filesystem objects (files and directories) manipulation.

This extension can also operate in standalone mode, i.e. without Yii.


Quick overview
--------------

`Properties`
    * exists
    * isdir
    * isfile
    * isempty
    * isuploaded
    * readable
    * writeable
    * realpath
    * basename (+setter)
    * filename (+setter)
    * dirname
    * extension (+setter)
    * mimeType
    * timeModified
    * size
    * owner (+setter)
    * group (+setter)
    * permissions (+setter)

`Methods`
    * create
    * createdir
    * purge
    * contents
    * copy
    * rename/move
    * send/download
    * delete


Requirements
------------

    * PHP 5.1+ and Yii 1.0 or above to use as Yii extension. 
    * PHP 5.1+ to use without Yii.


Installation
------------

    * For Yii: extract extension files under `protected/extensions/file`.
    * W/o Yii: extract extension files into a directory of choise.


Usage
-----

To use with Yii Framework:

  * Introduce CFile to Yii.
  * Add definition to CWebApplication config file (main.php)

   ::

    'components'=>array(
        ...
        'file'=>array(
            'class'=>'application.extensions.file.CFile',
        ),
        ...
    ),

  * Now you can access CFile properties and methods as follows:

   ::

    $myfile = Yii::app()->file->set('files/test.txt', true);
    /*
     * We use set() method to link new CFile object to our file. First set() parameter 
     * - 'files/test.txt' - is the file path (here we supply relative path wich 
     * is automatically converted into real file path such as '/var/www/htdocs/files/test.txt'). 
     * Second set() parameter - true - tells CFile to get all file properties at the very 
     * beginning (it could be omitted if we don't need all of them).
     */

    // $myfile now contains CFile object, let's see what do we got there.

    var_dump($myfile);  // You may dump object to see all its properties,
    echo $myfile->size;  // or get property,
    $myfile->permissions = 755;  // or set property,
    $mynewfile = $myfile->copy('test2.txt');  // or manipulate file somehow, e.g. copy.

    // Please see CFile methods for actions available.

    /*
     * Now $mynewfile contains new CFile object.
     * In this example file 'test2.txt' created in the same directory as our first 'test.txt' file.
     */

    // The following is also valid.
    if (Yii::app()->file->set('files/test3.txt')->exists) {
        echo 'Bingo-bongo!';
    } else {
        echo 'No-no-no.';
    }

    /*
     * Since 0.5 you can manipulate uploaded files (through CUploadedFile Yii class).
     * 
     * Let's suppose that we have the following form in our html:
     * 
     * <form enctype="multipart/form-data" method="post">
     *   <input type="file" name="myupload"/>
     *   <input type="submit"/>
     * </form>
     * 
     * After the form is submitted we can handle uploaded file as usual.
     */
    $uploaded = Yii::app()->file->set('myupload');

    // Let's copy newly uploaded file into 'files' directory with its original name.
    $newfile = $uploaded->copy('files/' . $uploaded->basename);

    /*
     * Since 0.6 you can use Yii path aliases.
     * See http://www.yiiframework.com/doc/guide/basics.namespace for information about path aliases.
     * 
     * Now let's get the contents of the directory where CFile resides
     * (supposing that it is in Yii extensions path in the 'file' subdirectory).
     */
    $cfileDir = Yii::app()->file->set('ext.file');
    print_r($cfileDir->contents);

    /*
     * Directory contents filtering was also introduced in 0.6.
     * 
     * Futher we get all php files from $cfileDir mentioned above.
     * We do not need all the decendants (recursion) so we supply 'false' as the first parameter
     * for getContents() method.
     * The second parameter describes filter, i.e. let me see only 'php' files.
     * You can supply an array of rules (eg. array('php', 'txt')).
     * NB: Moreover you can define perl regular expressions as rules.
     */
    print_r($cfileDir->getContents(false, 'php'));

    /*
     * Since 0.8 you can boost up file downloads.
     * Feature requires 'x-sendfile' header support from server (eg. Apache with mod_xsendfile 
     * or lighttpd).
     * If CFile::download() second parameter ('serverHandled') is set to True file download uses 
     * server internals.
     */
    $myfile->download('myfastfile.txt', true);

  * The other way to use this class is to import it into Yii:

   ::

    Yii::import('application.extensions.file.CFile');

    if (CFile::set('files/test3.txt')->exists) {
        echo 'Bingo-bongo!';
    } else {
        echo 'No-no-no.';
    }


To use without Yii simply import CFileHelper.php when needed and use CFileHelper::get() to get CFile object for a filesystem resource.

   ::

    $cf_file = CFileHelper::get('files/test.txt');  // $cf_cile now contains CFile object, use it as required.
    $cf_file->copy('mycopy.txt');


Further reading
---------------

Detailed information about class properties and methods could be found in CFile.php source code, do not hesitate to digg into it.


Get involved into ist-yii-cfile
-------------------------------

**Submit issues.** If you spotted something weird in application behavior or want to propose a feature you can do that at https://github.com/idlesign/ist-yii-cfile/issues

**Write code.** If you are eager to participate in application development, fork it at https://github.com/idlesign/ist-yii-cfile, write your code, whether it should be a bugfix or a feature implementation, and make a pull request right from the forked project page.


The tip
-------

You might be interested in other Yii extensions — http://www.yiiframework.com/extensions/
