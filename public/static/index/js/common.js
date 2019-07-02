/*
 * @Description: In User Settings Edit
 * @Author: haohao 
 * @LastEditors: Please set LastEditors
 * @Date: 2019-04-10 09:11:07
 * @LastEditTime: 2019-07-02 14:16:09
 * common.js
 */
 //参数设置，若用默认值可以省略以下面代
toastr.options = {
    "closeButton": false, //是否显示关闭按钮
    "debug": false, //是否使用debug模式
    "positionClass": "toast-top-center",//弹出窗的位置
    "showDuration": "300",//显示的动画时间
    "hideDuration": "1000",//消失的动画时间
    "timeOut": "2000", //展现时间
    "extendedTimeOut": "1000",//加长展示时间
    "showEasing": "swing",//显示时的动画缓冲方式
    "hideEasing": "linear",//消失时的动画缓冲方式
    "showMethod": "fadeIn",//显示时的动画方式
    "hideMethod": "fadeOut" //消失时的动画方式
};


 //生成唯一标识
 function getUUID()
 {
     var uuid = new Date().getTime();
     var randomNum =parseInt(Math.random()*1000);
     return uuid+randomNum.toString();
 }
 //写cookie
 function setCookie(name,value)
 {
     var Days = 365;//这里设置cookie存在时间为一年
     var exp = new Date();
     exp.setTime(exp.getTime() + Days*24*60*60*1000);
     document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
 }
 //获取cookie
 function getCookie(name)
 {
     var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
     if(arr=document.cookie.match(reg))
         return unescape(arr[2]);
     else
         return null;
 }
 var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/"; 
 var base64DecodeChars = new Array( 
     -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 
     -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 
     -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63, 
     52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1, 
     -1,  0,  1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 
     15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1, 
     -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 
     41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1); 

function base64encode(str) { 
 var out, i, len; 
 var c1, c2, c3; 

 len = str.length; 
 i = 0; 
 out = ""; 
 while(i < len) { 
     c1 = str.charCodeAt(i++) & 0xff; 
     if(i == len) 
     { 
         out += base64EncodeChars.charAt(c1 >> 2); 
         out += base64EncodeChars.charAt((c1 & 0x3) << 4); 
         out += "=="; 
         break; 
     } 
     c2 = str.charCodeAt(i++); 
     if(i == len) 
     { 
         out += base64EncodeChars.charAt(c1 >> 2); 
         out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4)); 
         out += base64EncodeChars.charAt((c2 & 0xF) << 2); 
         out += "="; 
         break; 
     } 
     c3 = str.charCodeAt(i++); 
     out += base64EncodeChars.charAt(c1 >> 2); 
     out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4)); 
     out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >>6)); 
     out += base64EncodeChars.charAt(c3 & 0x3F); 
 } 
 return out; 
} 