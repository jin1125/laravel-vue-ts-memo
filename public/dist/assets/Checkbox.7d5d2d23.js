import{f as r,q as u,D as d,h as l,o as i,c as p,p as f}from"./app.3370033c.js";const h=["value"],g={name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{type:String,default:null}},emits:["update:checked"],setup(o,{emit:s}){const a=o,e=r({get(){return a.checked},set(t){s("update:checked",t)}});return(t,c)=>u((i(),p("input",{"onUpdate:modelValue":c[0]||(c[0]=n=>f(e)?e.value=n:null),type:"checkbox",value:o.value,class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"},null,8,h)),[[d,l(e)]])}};export{g as _};
