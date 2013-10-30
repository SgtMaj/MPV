<?php
    /**
    * Debug tool to print a variable
    * @param mixed var The variable to print
    * @param int line The line where this function is call
    * @param path file The file where this function is call
    * @param bool return Return or print the variable
    * @return HTML
    */
    function dbg($var, $line, $file, $return = false) {
        $x  = '<pre style="width=940px; margin: 20px auto; padding: 20px; color: #ccc; background: #333; border: 1px solid #ccc; white-space: pre-wrap;">';
        $x .= '<strong style="width: 100%; margin-bottom: 10px; line-height: 1.5em; font-size: 1.2em; color: #333; text-indent: 10px; background: #38C7F7; display: inline-block;">Line ' . $line . ' - file : ' . $file . '</strong><br />';
        $x .= print_r($var, 1);
        $x .= '</pre>';

        if($return)
            return $x;
        else
            print $x;
    }

    /**
     * Returns the HTML code to display grid on a page
     * @param  void
     * @return HTML The code to display grid and switch
     */
    function getDevGridHTML() {
        $gridBgData = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAG0AAABuCAYAAAAtbJ34AAABR0lEQVR4nO3asQkCQRRF0QENZJuwIrveIqzDxNQavgjjhbNw8oHL/uit1+V4sNd73e4Ta/eDES1JtCDRgkQLEi1ItCDRgkQLEi1ItCDRgkQLEi1ItCDRgkQLEi1ItCDRgsbRntfjpMWf9gecxyDRgkQLEi1ItCDRgkQLEi1ItCDRgkQLEi1ItCDRgkQLEi1ItCDRgkQLEi1oHG33sghrrCTnMUi0INGCRAsSLUi0INGCRAsSLUi0INGCRAsSLUi0INGCRAsSLUi0INGCRAsaR9u9LMIaK8l5DBItSLQg0YJECxItSLQg0YJECxItSLQg0YJECxItSLQg0YJECxItSLQg0YLG0XYvi/hijTWtzO+t6bf7wYiWJFqQaEGiBYkWJFqQaEGiBYkWJFqQaEGiBYkWJFqQaEGiBYkWJFqQaEHjaLuXRcx9ANmPHxerwzJSAAAAAElFTkSuQmCC';

        // $gridSwitchData = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAAZklEQVRIie2TQQqAMAwEp/m84EV8ba0U9FKhhlix9piBQLJMjgswAxE4ykRg4s4vJ1XhNZt67nZCWSxCtXc78vA4DAF2I0/q7nYEWIFchRlYlDjKcWy8aE3Hi/bVcWy8aE3Hi/bqnBNcmLAW4ZpjAAAAAElFTkSuQmCC';

        $gridSwitchData = 'data:image/png; charset=binary;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAiJJREFUeNq0lU+K4kAUhysxJqse8M9ujqF4gJ6DzEJQMLQirm1cuctCELyAzC1m6AP0pg/hoqFBmVmZqJnfr6xIpalKNdNMwcOXV19SRV59xhsMBokQIkZE4jrSVqu1XS6Xj8jf+v3+MQiCSgZxHA6HRibwff+hVqvV8Surl8slPBwO35E+IX5hbudiEFYmCMOwjiEwKSfO57NI05QXXcQLdr+rX4eV4QK253ABwcCD5MTpdBKe5zG9Q4SsuxgmNgbXQYaQq2sjLxLuyMVw2Bi/2Wz+wEqXooJ3mPd6vVekf9go1j7DeHmef8X1N0QH8UXN/0Y8s4GTyWS3Wq0qGfYAYWQCdcx+qmaFxRFT9Tc2y8WoayPjxXEsG6MdL9kgPpg566oPRmaz2YiqQQ8SvKYYN0Xq5rTdbm8Xi4WUCAId0bhKhqKNx+MEPYgRNwZ92XJLDyxylwwsGO73e0p0j2irXVcyarNGJiiOli5IlmUl0VwMm2xjWBVRFJUEUUNKxBtcDBMbwwWy4q+AQxmaawIJF6MWMDJ+o9EoCYI873a7JYk+wzhFm81muyRJ/p9o6l3+u2g4v/I96923iWZi1uv1x0QDLAVBLiWaz+dSotFodBPNxlC06XRaEo0M+nIVDYs4RatiCtFMzE00/fzaRLMxumjvmZtoxflFsSSR8qCS0UV7z/CTmRXf00IQnmH9i+Zi1CfTyBhF63Q6Tok+yvwVYADPlKwTSR002wAAAABJRU5ErkJggg==';

        $gridHTML = '
            <div id="grid" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; background: transparent url(' . $gridBgData . ') repeat 0 0; opacity: 0.4; z-index: -1;"></div>

            <div id="toggle-grid" style="width: 32px; height: 32px; line-height: 28px; text-align: center; padding: 0; position: fixed; bottom: 25px; right: 0; background: #bfbfbf;border-radius: 3px 0px 0px 3px; cursor: pointer">
                <img src="' . $gridSwitchData . '" width="24px" height="24px" alt="" />
            </div>

            <script>
                $("#grid").height($(document).height());

                $("#toggle-grid").click(function() {
                    $("#grid").toggleClass("hidden");
                });

                $(document).keypress(function(e) {
                    if (e.which == 32) {
                        $("#toggle-grid").trigger("click");
                        e.preventDefault();
                    }
                });
            </script>
        ';

        return $gridHTML;
    }

    /**
     * Encodes a file with base64
     * @param string $filename The path to the file
     * @return string The encoded data
     */
    function encodeFileToBase64($filename) {
        // $handle = fopen($filename, "r");
        // $contents = fread($handle, filesize($filename));
        $contents = file_get_contents($filename);
        $mimetype = getMimeType($filename);

        return 'data:' . $mimetype . ';base64,' . base64_encode($contents);
    }

    /**
     * Returns the content type in MIME format
     * @param string $filename The path to the file
     * @return string the MIME type
     *
     * @see encodeFileToBase64
     */
    function getMimeType($filename) {
        if (function_exists('finfo_open')) {
            // extension php_fileinfo
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);

            return $mimetype;
        }
        elseif (function_exists('mime_content_type')) {
            return mime_content_type($filename);
        }
        else {
            $mime_types = array(
                'css' => 'text/css',
                'htm' => 'text/html',
                'html' => 'text/html',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'php' => 'text/html',
                'swf' => 'application/x-shockwave-flash',
                'txt' => 'text/plain',
                'xml' => 'application/xml',
                // images
                'bmp' => 'image/bmp',
                'gif' => 'image/gif',
                'ico' => 'image/x-icon',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
                'tif' => 'image/tiff',
                'tiff' => 'image/tiff',
                // archives
                '7z' => 'application/x-7z-compressed',
                'cab' => 'application/vnd.ms-cab-compressed',
                'exe' => 'application/x-msdownload',
                'gz' => 'multipart/x-gzip',
                'gzip' => 'multipart/x-gzip',
                'msi' => 'application/x-msdownload',
                'rar' => 'application/x-rar-compressed',
                'tar' => 'application/x-tar',
                'zip' => 'multipart/x-zip',
                // audio
                'mp3' => 'audio/mpeg',
                'ogg' => 'audio/ogg',
                'wav' => 'audio/x-wav',
                //video
                'avi' => 'video/msvideo',
                'flv' => 'video/x-flv',
                'mov' => 'video/quicktime',
                'mp4' => 'video/mp4',
                'ogv' => 'video/ogg',
                'qt' => 'video/quicktime',
                'webm' => 'video/webm',
                // adobe
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'pdf' => 'application/pdf',
                'ps' => 'application/postscript',
                'psd' => 'image/vnd.adobe.photoshop',
                // ms office
                'doc' => 'application/msword',
                'ppt' => 'application/vnd.ms-powerpoint',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
                // open office
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
                'odt' => 'application/vnd.oasis.opendocument.text',
            );

            $ext = strtolower(array_pop(explode('.', $filename)));
            if (array_key_exists($ext, $mime_types)) {
                return $mime_types[$ext];
            }
            else {
                return 'application/octet-stream';
            }
        }
    }
