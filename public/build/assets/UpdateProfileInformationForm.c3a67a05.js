import{C as x,u as b,o as n,g as m,d as a,a as t,b as e,e as u,w as c,j as y,v as k,h as g,T as V,f as w,L as S}from"./app.c6576bad.js";import{a as d,b as f,_ as p}from"./TextInput.99103e8e.js";import{_ as C}from"./PrimaryButton.af9bdbc9.js";const N=a("header",null,[a("h2",{class:"text-lg font-medium text-gray-900"}," Profile Information "),a("p",{class:"mt-1 text-sm text-gray-600"}," Update your account's profile information and email address. ")],-1),P={class:"flex items-center space-x-2"},U={key:0},$={class:"text-sm mt-2 text-gray-800"},B={class:"mt-2 font-medium text-sm text-green-600"},E={class:"flex items-center gap-4"},I={key:0,class:"text-sm text-gray-600"},L={__name:"UpdateProfileInformationForm",props:{mustVerifyEmail:Boolean,status:String},setup(v){const _=v,r=x().props.value.auth.user,s=b({name:r.name,email:r.email,is_public:r.is_public}),h=i=>{i.target.value=i.target.checked?1:0};return(i,l)=>(n(),m("section",null,[N,a("form",{onSubmit:l[3]||(l[3]=w(o=>e(s).patch(i.route("profile.update")),["prevent"])),class:"mt-6 space-y-6"},[a("div",null,[a("div",P,[t(d,{id:"is_public",type:"checkbox",class:"cursor-pointer",modelValue:e(s).is_public,"onUpdate:modelValue":l[0]||(l[0]=o=>e(s).is_public=o),checked:!!e(s).is_public,onClick:h},null,8,["modelValue","checked"]),t(p,{for:"is_public",value:"Public profile",class:"cursor-pointer"})]),t(f,{class:"mt-2",message:e(s).errors.name},null,8,["message"])]),a("div",null,[t(p,{for:"name",value:"Name"}),t(d,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:e(s).name,"onUpdate:modelValue":l[1]||(l[1]=o=>e(s).name=o),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),t(f,{class:"mt-2",message:e(s).errors.name},null,8,["message"])]),a("div",null,[t(p,{for:"email",value:"Email"}),t(d,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e(s).email,"onUpdate:modelValue":l[2]||(l[2]=o=>e(s).email=o),required:"",autocomplete:"email"},null,8,["modelValue"]),t(f,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),_.mustVerifyEmail&&e(r).email_verified_at===null?(n(),m("div",U,[a("p",$,[u(" Your email address is unverified. "),t(e(S),{href:i.route("verification.send"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:c(()=>[u(" Click here to re-send the verification email. ")]),_:1},8,["href"])]),y(a("div",B," A new verification link has been sent to your email address. ",512),[[k,_.status==="verification-link-sent"]])])):g("",!0),a("div",E,[t(C,{disabled:e(s).processing},{default:c(()=>[u("Save")]),_:1},8,["disabled"]),t(V,{"enter-from-class":"opacity-0","leave-to-class":"opacity-0",class:"transition ease-in-out"},{default:c(()=>[e(s).recentlySuccessful?(n(),m("p",I," Saved. ")):g("",!0)]),_:1})])],32)]))}};export{L as default};