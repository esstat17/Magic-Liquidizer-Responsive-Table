/*
* Plugin Name: Magic Liquidizer Responsive Table
* Plugin URI: http://www.innovedesigns.com/wordpress/magic-liquidizer-responsive-table-rwd-you-must-have-wp-plugin/
* Author: Elvin Deza
* Description: A simple and lightweight plugin that converts HTML table into responsive. After activation, go to Dashboard > * Appearance > Magic Liquidizer Responsive Table.
* Version: 1.0.4
* Tags: responsive, fluid
* Author URI: http://innovedesigns.com/author/esstat17
*/

 // responsive
(function(f,h,e){var g=f.jQuery;if(typeof module!="undefined"&&module.exports){module.exports=e(g)}else{f[h]=e(g)}}(this,"responsive",function(R){if(typeof R!="function"){try{console.log("jQuery is missing")}catch(K){}}var X,u=this,r="responsive",S=window,s=document,I=s.documentElement,L=R.domReady||R,J=R(S),V=S.screen,Y=V.width,O=V.height,T=function(){return Y},M=function(){return O},e=Object.create||function(a){function b(){}b.prototype=a;return new b},P=function(b,a){a=a||r;return b.replace(t,"")+"."+a.replace(t,"")},W=S.matchMedia||S.msMatchMedia,Q=W||function(){return{}},U=(function(a,f,b){var d=f.clientWidth,c=a.innerWidth;return(b&&d<c&&true===b("(min-width:"+c+"px)")["matches"]?function(){return a.innerWidth}:function(){return f.clientWidth})}(S,I,W)),N=(function(a,f,b){var d=f.clientHeight,c=a.innerHeight;return(b&&d<c&&true===b("(min-height:"+c+"px)")["matches"]?function(){return a.innerHeight}:function(){return f.clientHeight})}(S,I,W));function x(a,b,c){if(null==a){return a}if(typeof a=="object"&&!a.nodeType&&isNumber(a.length)){each(a,b,c)}else{b.call(c||a,a)}return a}function z(a){J.on("resize",a);return X}function m(a){x(a,function(b){L(b);z(b)});return X}X={deviceMin:function(){return D},deviceMax:function(){return F},action:m,resize:z,ready:L,deviceW:T,deviceH:M,viewportH:N,viewportW:U};return X}));
