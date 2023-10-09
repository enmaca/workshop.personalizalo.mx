import{c as w,g}from"./_commonjsHelpers-725317a4.js";var m={exports:{}};/*!
 * Toastify js 1.12.0
 * https://github.com/apvarun/toastify-js
 * @license MIT licensed
 *
 * Copyright (C) 2018 Varun A P
 */(function(r){(function(o,i){r.exports?r.exports=i():o.Toastify=i()})(w,function(o){var i=function(t){return new i.lib.init(t)},v="1.12.0";i.defaults={oldestFirst:!0,text:"Toastify is awesome!",node:void 0,duration:3e3,selector:void 0,callback:function(){},destination:void 0,newWindow:!1,close:!1,gravity:"toastify-top",positionLeft:!1,position:"",backgroundColor:"",avatar:"",className:"",stopOnFocus:!0,onClick:function(){},offset:{x:0,y:0},escapeMarkup:!0,ariaLive:"polite",style:{background:""}},i.lib=i.prototype={toastify:v,constructor:i,init:function(t){return t||(t={}),this.options={},this.toastElement=null,this.options.text=t.text||i.defaults.text,this.options.node=t.node||i.defaults.node,this.options.duration=t.duration===0?0:t.duration||i.defaults.duration,this.options.selector=t.selector||i.defaults.selector,this.options.callback=t.callback||i.defaults.callback,this.options.destination=t.destination||i.defaults.destination,this.options.newWindow=t.newWindow||i.defaults.newWindow,this.options.close=t.close||i.defaults.close,this.options.gravity=t.gravity==="bottom"?"toastify-bottom":i.defaults.gravity,this.options.positionLeft=t.positionLeft||i.defaults.positionLeft,this.options.position=t.position||i.defaults.position,this.options.backgroundColor=t.backgroundColor||i.defaults.backgroundColor,this.options.avatar=t.avatar||i.defaults.avatar,this.options.className=t.className||i.defaults.className,this.options.stopOnFocus=t.stopOnFocus===void 0?i.defaults.stopOnFocus:t.stopOnFocus,this.options.onClick=t.onClick||i.defaults.onClick,this.options.offset=t.offset||i.defaults.offset,this.options.escapeMarkup=t.escapeMarkup!==void 0?t.escapeMarkup:i.defaults.escapeMarkup,this.options.ariaLive=t.ariaLive||i.defaults.ariaLive,this.options.style=t.style||i.defaults.style,t.backgroundColor&&(this.options.style.background=t.backgroundColor),this},buildToast:function(){if(!this.options)throw"Toastify is not initialized";var t=document.createElement("div");t.className="toastify on "+this.options.className,this.options.position?t.className+=" toastify-"+this.options.position:this.options.positionLeft===!0?(t.className+=" toastify-left",console.warn("Property `positionLeft` will be depreciated in further versions. Please use `position` instead.")):t.className+=" toastify-right",t.className+=" "+this.options.gravity,this.options.backgroundColor&&console.warn('DEPRECATION NOTICE: "backgroundColor" is being deprecated. Please use the "style.background" property.');for(var s in this.options.style)t.style[s]=this.options.style[s];if(this.options.ariaLive&&t.setAttribute("aria-live",this.options.ariaLive),this.options.node&&this.options.node.nodeType===Node.ELEMENT_NODE)t.appendChild(this.options.node);else if(this.options.escapeMarkup?t.innerText=this.options.text:t.innerHTML=this.options.text,this.options.avatar!==""){var l=document.createElement("img");l.src=this.options.avatar,l.className="toastify-avatar",this.options.position=="left"||this.options.positionLeft===!0?t.appendChild(l):t.insertAdjacentElement("afterbegin",l)}if(this.options.close===!0){var n=document.createElement("button");n.type="button",n.setAttribute("aria-label","Close"),n.className="toast-close",n.innerHTML="&#10006;",n.addEventListener("click",(function(u){u.stopPropagation(),this.removeElement(this.toastElement),window.clearTimeout(this.toastElement.timeOutValue)}).bind(this));var e=window.innerWidth>0?window.innerWidth:screen.width;(this.options.position=="left"||this.options.positionLeft===!0)&&e>360?t.insertAdjacentElement("afterbegin",n):t.appendChild(n)}if(this.options.stopOnFocus&&this.options.duration>0){var a=this;t.addEventListener("mouseover",function(u){window.clearTimeout(t.timeOutValue)}),t.addEventListener("mouseleave",function(){t.timeOutValue=window.setTimeout(function(){a.removeElement(t)},a.options.duration)})}if(typeof this.options.destination<"u"&&t.addEventListener("click",(function(u){u.stopPropagation(),this.options.newWindow===!0?window.open(this.options.destination,"_blank"):window.location=this.options.destination}).bind(this)),typeof this.options.onClick=="function"&&typeof this.options.destination>"u"&&t.addEventListener("click",(function(u){u.stopPropagation(),this.options.onClick()}).bind(this)),typeof this.options.offset=="object"){var f=p("x",this.options),d=p("y",this.options),c=this.options.position=="left"?f:"-"+f,y=this.options.gravity=="toastify-top"?d:"-"+d;t.style.transform="translate("+c+","+y+")"}return t},showToast:function(){this.toastElement=this.buildToast();var t;if(typeof this.options.selector=="string"?t=document.getElementById(this.options.selector):this.options.selector instanceof HTMLElement||typeof ShadowRoot<"u"&&this.options.selector instanceof ShadowRoot?t=this.options.selector:t=document.body,!t)throw"Root element is not defined";var s=i.defaults.oldestFirst?t.firstChild:t.lastChild;return t.insertBefore(this.toastElement,s),i.reposition(),this.options.duration>0&&(this.toastElement.timeOutValue=window.setTimeout((function(){this.removeElement(this.toastElement)}).bind(this),this.options.duration)),this},hideToast:function(){this.toastElement.timeOutValue&&clearTimeout(this.toastElement.timeOutValue),this.removeElement(this.toastElement)},removeElement:function(t){t.className=t.className.replace(" on",""),window.setTimeout((function(){this.options.node&&this.options.node.parentNode&&this.options.node.parentNode.removeChild(this.options.node),t.parentNode&&t.parentNode.removeChild(t),this.options.callback.call(t),i.reposition()}).bind(this),400)}},i.reposition=function(){for(var t={top:15,bottom:15},s={top:15,bottom:15},l={top:15,bottom:15},n=document.getElementsByClassName("toastify"),e,a=0;a<n.length;a++){h(n[a],"toastify-top")===!0?e="toastify-top":e="toastify-bottom";var f=n[a].offsetHeight;e=e.substr(9,e.length-1);var d=15,c=window.innerWidth>0?window.innerWidth:screen.width;c<=360?(n[a].style[e]=l[e]+"px",l[e]+=f+d):h(n[a],"toastify-left")===!0?(n[a].style[e]=t[e]+"px",t[e]+=f+d):(n[a].style[e]=s[e]+"px",s[e]+=f+d)}return this};function p(t,s){return s.offset[t]?isNaN(s.offset[t])?s.offset[t]:s.offset[t]+"px":"0px"}function h(t,s){return!t||typeof s!="string"?!1:!!(t.className&&t.className.trim().split(/\s+/gi).indexOf(s)>-1)}return i.lib.init.prototype=i.lib,i})})(m);var b=m.exports;const k=g(b);window.inited_toasties=[];window.init_toasties=function(){let r=document.querySelectorAll("[data-toast]");Array.from(r).forEach(function(o){window.init_toastie_elem(o)})};window.init_toastie_elem=function(r){r.addEventListener("click",function(){let o={},i=r.attributes;i["data-toast-text"]&&(o.text=i["data-toast-text"].value.toString()),i["data-toast-gravity"]&&(o.gravity=i["data-toast-gravity"].value.toString()),i["data-toast-position"]&&(o.position=i["data-toast-position"].value.toString()),i["data-toast-className"]&&(o.className=i["data-toast-className"].value.toString()),i["data-toast-duration"]&&(o.duration=i["data-toast-duration"].value.toString()),i["data-toast-close"]&&(o.close=i["data-toast-close"].value.toString()),i["data-toast-style"]&&(o.style=i["data-toast-style"].value.toString()),i["data-toast-offset"]&&(o.offset=i["data-toast-offset"]),k({newWindow:!0,text:o.text,gravity:o.gravity,position:o.position,className:"bg-"+o.className,stopOnFocus:!0,offset:{x:o.offset?50:0,y:o.offset?10:0},duration:o.duration,close:o.close==="close",style:o.style==="style"?{background:"linear-gradient(to right, #0AB39C, #405189)"}:""}).showToast()})};
