import{_ as p}from"./GuestLayout.fb2023c7.js";import{_ as k}from"./AuthenticatedLayout.9b4abfd6.js";import{r as F,k as S,o as s,g as a,a as y,b as i,c as f,w as m,D as U,h as r,H as I,d as l,t as u,F as T,q as B,E as C}from"./app.c6576bad.js";import{T as $}from"./Tweet.e0986ff4.js";import{u as D,a as N,_ as V,b as E}from"./FeedItem.8e78b792.js";import"./NavLink.103ec0a0.js";const H={key:0},L={class:"flex justify-between"},j={class:"font-semibold text-xl text-gray-800 leading-tight"},q={class:"flex space-x-2"},M=l("span",null,"Following",-1),P={class:"flex space-x-2"},Y={key:0,class:"text-center"},z=l("br",null,null,-1),A={key:0},G=l("i",null,"You are following",-1),J=[G],K={class:"py-12"},O={key:0,class:"text-center p-8"},le={__name:"Index",setup(Q){const n=D(),o=N(),e=F(null);S(()=>{c(),b(),x()});const c=()=>{n.fetchUserFeed(route().params).then(t=>{n.tweets=t==null?void 0:t.data})},b=()=>{o.profile(route().params).then(t=>{e.value=t==null?void 0:t.data})},g=t=>{var d;if(!((d=o.user)!=null&&d.id)){C.Inertia.visit("login");return}if(e.value.is_followed_by_me){e.value.is_followed_by_me=0,n.tweets={},o.unfollow({id:e.value.id}).then(()=>e.value.followers_count--).catch(_=>{e.value.is_followed_by_me=1,c()});return}e.value.is_followed_by_me=1,o.follow({id:e.value.id}).then(()=>{e.value.followers_count++,c()}).catch(_=>e.value.is_followed_by_me=0)},x=()=>{o.me().then(t=>{o.user=t==null?void 0:t.data,window.localStorage.setItem("user",o.user)}).catch(t=>{o.user={},window.localStorage.removeItem("user")})};return(t,d)=>{var _;return e.value?(s(),a("div",H,[y(i(I),{title:"User feed"}),(s(),f(U((_=i(o).user)!=null&&_.id?k:p),null,{header:m(()=>[l("div",L,[l("div",null,[l("h2",j,u(e.value.name),1),l("div",null,[l("div",q,[l("b",null,u(e.value.following_count),1),M]),l("div",P,[l("b",null,u(e.value.followers_count),1),l("span",null,u(e.value.followers_count>1?"Followers":"Follower"),1)])])]),e.value.id!=i(o).user.id?(s(),a("div",Y,[l("button",{class:"bg-[#414141] rounded-2xl px-8 py-2 text-white disabled:opacity-50",onClick:g},u(e.value.is_followed_by_me?"Unfollow":"Follow"),1),z,e.value.is_followed_by_me?(s(),a("small",A,J)):r("",!0)])):r("",!0)])]),default:m(()=>[l("div",K,[y(V,null,{default:m(()=>{var w,v;return[!e.value.is_followed_by_me&&!e.value.is_public?(s(),a("div",O," This user profile is private, follow to see user feed ")):r("",!0),((w=i(o).user)==null?void 0:w.id)==e.value.id?(s(),f($,{key:1})):r("",!0),(s(!0),a(T,null,B((v=i(n).tweets)==null?void 0:v.data,h=>(s(),f(E,{item:h,key:h.id},null,8,["item"]))),128))]}),_:1})])]),_:1}))])):r("",!0)}}};export{le as default};