import{s as I,n as R}from"../chunks/scheduler.CtbWrGNo.js";import{S as q,i as O,s as u,e as $,c as y,h as T,d as t,a as h,b as x,f as g,g as v,j as D,k as m,m as k,t as w,l as E,n as S}from"../chunks/index.BouBDcJu.js";import{N as C,n as F}from"../chunks/index.B7ax2p7f.js";import{S as Q,F as j}from"../chunks/search_form.DFWQsWY6.js";function B(c){let l,s,d,r,p,i,n,_,f,o,b;return r=new C({props:{nav_array:F,title:H}}),n=new Q({props:{form_array:c[0]}}),o=new j({props:{formset_array:c[1]}}),{c(){l=u(),s=$("datalist"),d=u(),y(r.$$.fragment),p=u(),i=$("header"),y(n.$$.fragment),_=u(),f=$("main"),y(o.$$.fragment),this.h()},l(e){T("svelte-2lc5d7",document.head).forEach(t),l=h(e),s=x(e,"DATALIST",{id:!0}),g(s).forEach(t),d=h(e),v(r.$$.fragment,e),p=h(e),i=x(e,"HEADER",{class:!0});var N=g(i);v(n.$$.fragment,N),N.forEach(t),_=h(e),f=x(e,"MAIN",{class:!0});var A=g(f);v(o.$$.fragment,A),A.forEach(t),this.h()},h(){document.title="Tool",D(s,"id","list_id"),D(i,"class","fixed top-[5vh] flex flex-row gap-4 w-screen bg-slate-700 h-[5vh] items-center pl-4"),D(f,"class","fixed flex flex-col top-[10vh] p-2 bg-slate-300 w-screen h-[90vh]")},m(e,a){m(e,l,a),m(e,s,a),m(e,d,a),k(r,e,a),m(e,p,a),m(e,i,a),k(n,i,null),m(e,_,a),m(e,f,a),k(o,f,null),b=!0},p:R,i(e){b||(w(r.$$.fragment,e),w(n.$$.fragment,e),w(o.$$.fragment,e),b=!0)},o(e){E(r.$$.fragment,e),E(n.$$.fragment,e),E(o.$$.fragment,e),b=!1},d(e){e&&(t(l),t(s),t(d),t(p),t(i),t(_),t(f)),S(r,e),S(n),S(o)}}}let H="Data Reference";function L(c){return[{id:"id_wo_search",list:"list_id",btn_set:[{method:"search",name:"search",onClick:d=>{console.log(d.target)}}]},{id:"detail_form",column:2,form:[{field:"id",label:"ID Number",type:"text",list:"list_id"},{field:"wo",label:"Work Order",type:"text",disable:""},{field:"item_number",label:"Item Number",type:"text",disable:""},{field:"desc",label:"Deskripsi",type:"text",disable:""},{field:"rel_dt",label:"Release Date",type:"date",disable:""},{field:"qty_ord",label:"Qty Order",type:"text",disable:""},{field:"due_dt",label:"Due Date",type:"date",disable:""},{field:"qty_opn",label:"Qty Open",type:"text",disable:""},{field:"status",label:"Status",type:"text",disable:""},{field:"eff_dt",label:"Effective Date",type:"date",disable:""},{field:"receipt",label:"Receipt",type:"checkbox"},{field:"backflush",label:"Backflush",type:"checkbox"}]}]}class G extends q{constructor(l){super(),O(this,l,L,B,I,{})}}export{G as component};