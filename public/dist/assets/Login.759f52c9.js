var k=Object.defineProperty,x=Object.defineProperties;var y=Object.getOwnPropertyDescriptors;var c=Object.getOwnPropertySymbols;var V=Object.prototype.hasOwnProperty,v=Object.prototype.propertyIsEnumerable;var u=(s,e,t)=>e in s?k(s,e,{enumerable:!0,configurable:!0,writable:!0,value:t}):s[e]=t,f=(s,e)=>{for(var t in e||(e={}))V.call(e,t)&&u(s,t,e[t]);if(c)for(var t of c(e))v.call(e,t)&&u(s,t,e[t]);return s},p=(s,e)=>x(s,y(e));import{A as $,o as d,c as _,b as o,h as a,H as B,w as i,F,t as L,i as b,a as r,e as C,L as N,n as S,j as q,s as h}from"./app.3370033c.js";import{J as P}from"./AuthenticationCard.96e9843a.js";import{_ as R}from"./AuthenticationCardLogo.ebd4ba9d.js";import{_ as U}from"./Button.c8a26ae4.js";import{_ as w}from"./Input.1fdaf216.js";import{_ as j}from"./Checkbox.7d5d2d23.js";import{_ as g}from"./Label.883f2072.js";import{_ as A}from"./ValidationErrors.85a096cc.js";import"./plugin-vue_export-helper.21dcd24c.js";const E={key:0,class:"mb-4 font-medium text-sm text-green-600"},H=["onSubmit"],J={class:"mt-4"},z={class:"block mt-4"},D={class:"flex items-center"},M=r("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),T={class:"flex items-center justify-end mt-4"},G=h(" Forgot your password? "),I=h(" Log in "),oe={name:"Login",props:{canResetPassword:Boolean,status:String},setup(s){const e=$({email:"",password:"",remember:!1}),t=()=>{e.transform(n=>p(f({},n),{remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(n,m)=>(d(),_(F,null,[o(a(B),{title:"Log in"}),o(P,null,{logo:i(()=>[o(R)]),default:i(()=>[o(A,{class:"mb-4"}),s.status?(d(),_("div",E,L(s.status),1)):b("",!0),r("form",{onSubmit:q(t,["prevent"])},[r("div",null,[o(g,{for:"email",value:"Email"}),o(w,{id:"email",modelValue:a(e).email,"onUpdate:modelValue":m[0]||(m[0]=l=>a(e).email=l),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),r("div",J,[o(g,{for:"password",value:"Password"}),o(w,{id:"password",modelValue:a(e).password,"onUpdate:modelValue":m[1]||(m[1]=l=>a(e).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"])]),r("div",z,[r("label",D,[o(j,{checked:a(e).remember,"onUpdate:checked":m[2]||(m[2]=l=>a(e).remember=l),name:"remember"},null,8,["checked"]),M])]),r("div",T,[s.canResetPassword?(d(),C(a(N),{key:0,href:n.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:i(()=>[G]),_:1},8,["href"])):b("",!0),o(U,{class:S(["ml-4",{"opacity-25":a(e).processing}]),disabled:a(e).processing},{default:i(()=>[I]),_:1},8,["class","disabled"])])],40,H)]),_:1})],64))}};export{oe as default};
