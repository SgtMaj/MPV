<?php include 'dev.func.php'; ?>
<?php
    $return = NULL;

    if ($_POST) {
        $return = dbg($_POST, __LINE__, __FILE__, TRUE);

        if (!empty($_POST['hash'])) {
            extract($_POST['hash']);

            $return = md5(sha1($salt1 . $un . $salt2 . $pwd . $salt3));
        }
        elseif (!empty($_POST['base64'])) {
            extract($_POST['base64']);

            if (file_exists($fn)) {
                $return = encodeFileToBase64($fn);
            }
            else {
                $return = 'The file <i>' . $fn . '</i> doesn\'t exist. Please check the path and retry.';
            }
        }
    }
?><!doctype html>
<html lang="fr" class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Dev tools</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
        <!--
            * {
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                -o-box-sizing: border-box;
                -ms-box-sizing: border-box;
            }

            html, body, #container {
                height: 100%;
                margin: 0;
                /*overflow: hidden;*/
                padding: 0;
            }

            body {
                background-color: #DDD;
                color: #555;
                font-family: "Trebuchet MS", Helvetica, sans-serif;
            }

            #container {
                margin: 0 auto;
                width: 960px;
            }

                .ff-serif {
                    font-family: Georgia, serif;
                }
                .ff-mono {
                    font-family: "Courier New", Courier, monospace;
                }

                .btn {
                    border: 0 none;
                    border-radius: 3px;
                    cursor: pointer;
                    display: inline-block;
                }
                .btn-primary {
                    background-color: #555;
                    box-shadow: 0 4px 0 #222;
                    color: #EEE;
                    padding: 4px;
                    text-align: center;
                    width: 82px;
                }
                .btn-secondary {
                    background-color: #C1D84B;
                    border-radius: 3px;
                    padding: 0 10px;
                }
                a.btn-secondary {
                    color: inherit;
                    text-decoration: none;
                }

                .right {
                    float: right;
                    margin: 0;
                }

                #header {
                    padding: 10px 0;
                }

                    h1 {
                        color: #DDD;
                        font-size: 64px;
                        margin: 0;
                        text-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
                    }

                #content {
                    background-color: #EEE;
                    border: 1px solid #CCC;
                    box-sizing: border-box;
                    padding: 15px;
                    height: 75%;
                }

                    small {
                        color: #BBB;
                        display: block;
                        font-style: italic;
                        text-align: right;
                    }

                        small i {
                            font-style: normal;
                        }

                    #tools {
                        align-items: stretch;
                        display: flex;
                    }

                        #tools div {
                            display: inline-block;
                            flex: 1;
                            padding: 0 44px;
                            position: relative;
                            width: 50%;
                        }

                        #hash-salt {
                            font-size: 12px;
                            height: 24px;
                            line-height: 24px;
                            text-align: right;
                        }

                        label {
                            display: inline-block;
                            padding-right: 10px;
                            text-align: right;
                            width: 100px;
                        }

                        input[type="submit"] {
                            position: absolute;
                            right: 46px;
                        }

                    #return {
                        margin-top: 90px;
                        position: relative;
                    }

                        p.code {
                            background-color: #FFF;
                            border: 1px solid #C1D84B;
                            font-size: 13px;
                            margin: 0 auto;
                            overflow-wrap: break-word;
                            padding: 15px;
                            width: 95%;
                            word-wrap: break-word;
                        }

                        #copy {
                            border-radius: 3px 3px 0 0;
                            font-size: 12px;
                            height: 24px;
                            line-height: 24px;
                            position: absolute;
                            right: 2.5%;
                            top: -24px;
                        }

                #footer {
                    font-size: 12px;
                    height: 24px;
                    line-height: 24px;
                }

                    #footer a {
                        text-decoration: none;
                    }

                    #footer a.btn-primary {
                        height: 26px;
                        line-height: 18px;
                    }
        -->
        </style>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <h1 class="ff-serif">Developpement tools</h1>
            </div>

            <div id="content">
                <div id="tools">
                    <div id="hash-tool">
                        <h2 class="ff-serif">Calculates the password hash</h2>

                        <form id="hash-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <p>
                                <label for="salt1">Salt #1</label>
                                <input type="text" id="salt1" name="hash[salt1]" size="40" />
                                <small>Use letters, digits and special characters</small>
                            </p>
                            <p>
                                <label for="salt2">Salt #2</label>
                                <input type="text" id="salt2" name="hash[salt2]" size="40" />
                            </p>
                            <p>
                                <label for="salt3">Salt #3</label>
                                <input type="text" id="salt3" name="hash[salt3]" size="40" />
                            </p>
                            <p id="hash-salt">
                                <a href="" class="btn btn-secondary" onclick="generateSalt(); return false;">Generate random salts</a>
                            </p>
                            <p>
                                <label for="un">Username</label>
                                <input type="text" id="un" name="hash[un]" size="40" />
                            </p>
                            <p>
                                <label for="pwd">Password</label>
                                <input type="password" id="pwd" name="hash[pwd]" size="40" />
                            </p>
                            <p>
                                <input type="submit" id="hash-submit" class="btn btn-primary" value="Calculates" />
                            </p>
                        </form>
                    </div>

                    <div id="base64-tool">
                        <h2 class="ff-serif">Encodes a file with Base64</h2>

                        <form id="base64-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <p>
                                <label for="fn">Filename</label>
                                <input type="text" id="fn" name="base64[fn]" size="40" />
                                <small>Expected format : <i>myPic.png</i> or <i>../img/myOtherPic.jpg</i></small>
                            </p>
                            <p>
                                <input type="submit" id="base64-submit" class="btn btn-primary" value="Encodes" />
                            </p>
                        </form>
                    </div>
                </div>

                <?php if ($return) : ?>
                <div id="return">
                    <p id="code" class="code ff-mono"><?php echo $return; ?></p>

                    <span id="copy" class="btn btn-secondary ff-mono">Copy to clipboard</span>
                </div>
                <?php else : ?>
                <div id="copy"></div>
                <?php endif; ?>
            </div>

            <div id="footer">
                <p class="right">
                    <a href="/" class="btn btn-primary">Home</a>
                    <a href="/__admin/" class="btn btn-primary">Admin</a>
                </p>
                <p>
                    &copy; 2013 MPV //
                    Developped by
                    <a href="https://github.com/SgtMaj" class="btn btn-secondary ff-mono" target="_blank">SgtMaj</a>
                    &amp;
                    <a href="https://github.com/scrattx" class="btn btn-secondary ff-mono" target="_blank">ScrAtTx</a>
                </p>
            </div>
        </div>

        <script>
            // Salt generation
            function generateSalt() {
                for (var i = 1; i < 4; i++) {
                    document.getElementById('salt' + i).value = getSalt();
                };
            }

            function getSalt() {
                var chars = '-abcdefghijklmnopqrstuvwxyz@ABCDEFGHIJKLMNOPQRSTUVWXYZ#0123456789!';
                var charsLength = chars.length;
                var salt = '';
                var saltLength = 18;

                for (var i = 0; i < saltLength; i++) {
                    salt += chars[mt_rand(0, charsLength - 1)];
                };

                return salt;
            }

            /* http://kevin.vanzonneveld.net
             *   original by: Onno Marsman
             *   improved by: Brett Zamir (http://brett-zamir.me)
             *   input by: Kongo
             *     example 1: mt_rand(1, 1);
             *     returns 1: 1
            */
            function mt_rand(min, max) {
                var argc = arguments.length;
                if (argc === 0) {
                    min = 0;
                    max = 2147483647;
                }
                else if (argc === 1) {
                    throw new Error('Warning: mt_rand() expects exactly 2 parameters, 1 given');
                }
                else {
                    min = parseInt(min, 10);
                    max = parseInt(max, 10);
                }

                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            // Simple Set Clipboard System
            // Author: Joseph Huckaby
            eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('8 g={13:"1.0.4",R:{},L:\'g.1L\',14:1,$:6(b){5(M(b)==\'15\')b=B.16(b);5(!b.C){b.N=6(){3.r.17=\'1M\'};b.18=6(){3.r.17=\'\'};b.C=6(a){3.D(a);3.O+=\' \'+a};b.D=6(a){3.O=3.O.E(19 1a("\\\\s*"+a+"\\\\s*")," ").E(/^\\s+/,\'\').E(/\\s+$/,\'\')};b.1b=6(a){u!!3.O.F(19 1a("\\\\s*"+a+"\\\\s*"))}}u b},1N:6(a){3.L=a},1O:6(a,b,c){8 d=3.R[a];5(d){d.P(b,c)}},1c:6(a,b){3.R[a]=b},S:6(a){8 b={t:0,v:0,j:a.j?a.j:a.1P,k:a.k?a.k:a.1Q};1R(a){b.t+=a.1S;b.v+=a.1T;a=a.1U}u b},1d:6(a){3.o={};3.p=g.14++;3.G=\'1V\'+3.p;g.1c(3.p,3);5(a)3.1e(a)}};g.1d.1W={p:0,w:l,q:y,T:\'\',U:H,z:H,o:y,1e:6(a){3.7=g.$(a);8 b=1X;5(3.7.r.V){b=1Y(3.7.r.V)+1}8 c=g.S(3.7);3.f=B.1Z(\'f\');8 d=3.f.r;d.20=\'21\';d.t=\'\'+c.t+\'A\';d.v=\'\'+c.v+\'A\';d.j=\'\'+c.j+\'A\';d.k=\'\'+c.k+\'A\';d.V=b;8 e=B.1f(\'1g\')[0];e.22(3.f);3.f.1h=3.1i(c.j,c.k)},1i:6(a,b){8 c=\'\';8 d=\'p=\'+3.p+\'&j=\'+a+\'&k=\'+b;5(W.X.F(/23/)){8 e=24.25.F(/^1j/i)?\'1j://\':\'1k://\';c+=\'<Y 26="27:28-29-2a-2b-2c" 2d="\'+e+\'2e.1l.1m/2f/1n/2g/1o/2h.2i#13=9,0,0,0" j="\'+a+\'" k="\'+b+\'" p="\'+3.G+\'" 1p="1q"><m h="1r" n="1s" /><m h="1t" n="l" /><m h="q" n="\'+g.L+\'" /><m h="1u" n="l" /><m h="1v" n="l" /><m h="1w" n="1x" /><m h="1y" n="#1z" /><m h="1A" n="\'+d+\'"/><m h="1B" n="1C"/></Y>\'}Z{c+=\'<2j p="\'+3.G+\'" 2k="\'+g.L+\'" 1u="l" 1v="l" 1w="1x" 1y="#1z" j="\'+a+\'" k="\'+b+\'" h="\'+3.G+\'" 1p="1q" 1r="1s" 1t="l" 2l="2m/x-1n-1o" 2n="1k://2o.1l.1m/2p/2q" 1A="\'+d+\'" 1B="1C" />\'}u c},N:6(){5(3.f){3.f.r.t=\'-2r\'}},18:6(){3.1D()},2s:6(){5(3.7&&3.f){3.N();3.f.1h=\'\';8 a=B.1f(\'1g\')[0];2t{a.2u(3.f)}2v(e){}3.7=y;3.f=y}},1D:6(a){5(a){3.7=g.$(a);5(!3.7)3.N()}5(3.7&&3.f){8 b=g.S(3.7);8 c=3.f.r;c.t=\'\'+b.t+\'A\';c.v=\'\'+b.v+\'A\'}},10:6(a){3.T=a;5(3.w)3.q.10(a)},2w:6(a,b){a=a.1E().1F().E(/^1G/,\'\');5(!3.o[a])3.o[a]=[];3.o[a].2x(b)},11:6(a){3.U=a;5(3.w)3.q.11(a)},2y:6(a){3.z=!!a},P:6(a,b){a=a.1E().1F().E(/^1G/,\'\');2z(a){I\'12\':3.q=B.16(3.G);5(!3.q){8 c=3;1H(6(){c.P(\'12\',y)},1);u}5(!3.w&&W.X.F(/2A/)&&W.X.F(/2B/)){8 c=3;1H(6(){c.P(\'12\',y)},2C);3.w=H;u}3.w=H;3.q.10(3.T);3.q.11(3.U);J;I\'2D\':5(3.7&&3.z){3.7.C(\'1I\');5(3.Q)3.7.C(\'K\')}J;I\'2E\':5(3.7&&3.z){3.Q=l;5(3.7.1b(\'K\')){3.7.D(\'K\');3.Q=H}3.7.D(\'1I\')}J;I\'2F\':5(3.7&&3.z){3.7.C(\'K\')}J;I\'2G\':5(3.7&&3.z){3.7.D(\'K\');3.Q=l}J}5(3.o[a]){2H(8 d=0,1J=3.o[a].1K;d<1J;d++){8 e=3.o[a][d];5(M(e)==\'6\'){e(3,b)}Z 5((M(e)==\'Y\')&&(e.1K==2)){e[0][e[1]](3,b)}Z 5(M(e)==\'15\'){2I[e](3,b)}}}}};',62,169,'|||this||if|function|domElement|var|||||||div|ZeroClipboard|name||width|height|false|param|value|handlers|id|movie|style||left|return|top|ready||null|cssEffects|px|document|addClass|removeClass|replace|match|movieId|true|case|break|active|moviePath|typeof|hide|className|receiveEvent|recoverActive|clients|getDOMObjectPosition|clipText|handCursorEnabled|zIndex|navigator|userAgent|object|else|setText|setHandCursor|load|version|nextId|string|getElementById|display|show|new|RegExp|hasClass|register|Client|glue|getElementsByTagName|body|innerHTML|getHTML|https|http|macromedia|com|shockwave|flash|align|middle|allowScriptAccess|always|allowFullScreen|loop|menu|quality|best|bgcolor|ffffff|flashvars|wmode|transparent|reposition|toString|toLowerCase|on|setTimeout|hover|len|length|swf|none|setMoviePath|dispatch|offsetWidth|offsetHeight|while|offsetLeft|offsetTop|offsetParent|ZeroClipboardMovie_|prototype|99|parseInt|createElement|position|absolute|appendChild|MSIE|location|href|classid|clsid|d27cdb6e|ae6d|11cf|96b8|444553540000|codebase|download|pub|cabs|swflash|cab|embed|src|type|application|pluginspage|www|go|getflashplayer|2000px|destroy|try|removeChild|catch|addEventListener|push|setCSSEffects|switch|Firefox|Windows|100|mouseover|mouseout|mousedown|mouseup|for|window'.split('|'),0,{}));

            ZeroClipboard.setMoviePath('ZeroClipboard.swf');
            ZeroClipboard.$('copy');
            var clip = new ZeroClipboard.Client();

            clip.addEventListener('mousedown', function() {
                clip.setText(document.getElementById('code').innerHTML);
            });
            clip.addEventListener('complete',function(client, text) {
                alert("Copied to clipboard:\n\n" + text);
            });

            clip.glue('copy');
        </script>
    </body>
</html>