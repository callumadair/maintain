import{z as u,o as c,c as f,b as s,h as a,w as l,F as _,H as w,a as r,n as V,j as b,s as k}from"./app.83ed3456.js";import{J as v}from"./AuthenticationCard.7d5a84a1.js";import{_ as g}from"./AuthenticationCardLogo.c2b35627.js";import{_ as h}from"./Button.9ed2e117.js";import{_ as i}from"./Input.1067b2ee.js";import{_ as m}from"./Label.708d93f0.js";import{_ as x}from"./ValidationErrors.7807366b.js";import"./plugin-vue_export-helper.21dcd24c.js";const y=["onSubmit"],P={class:"mt-4"},$={class:"mt-4"},C={class:"flex items-center justify-end mt-4"},F=k(" Reset Password "),H={__name:"ResetPassword",props:{email:String,token:String},setup(n){const d=n,o=u({token:d.token,email:d.email,password:"",password_confirmation:""}),p=()=>{o.post(route("password.update"),{onFinish:()=>o.reset("password","password_confirmation")})};return(S,e)=>(c(),f(_,null,[s(a(w),{title:"Reset Password"}),s(v,null,{logo:l(()=>[s(g)]),default:l(()=>[s(x,{class:"mb-4"}),r("form",{onSubmit:b(p,["prevent"])},[r("div",null,[s(m,{for:"email",value:"Email"}),s(i,{id:"email",modelValue:a(o).email,"onUpdate:modelValue":e[0]||(e[0]=t=>a(o).email=t),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),r("div",P,[s(m,{for:"password",value:"Password"}),s(i,{id:"password",modelValue:a(o).password,"onUpdate:modelValue":e[1]||(e[1]=t=>a(o).password=t),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"])]),r("div",$,[s(m,{for:"password_confirmation",value:"Confirm Password"}),s(i,{id:"password_confirmation",modelValue:a(o).password_confirmation,"onUpdate:modelValue":e[2]||(e[2]=t=>a(o).password_confirmation=t),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"])]),r("div",C,[s(h,{class:V({"opacity-25":a(o).processing}),disabled:a(o).processing},{default:l(()=>[F]),_:1},8,["class","disabled"])])],40,y)]),_:1})],64))}};export{H as default};
