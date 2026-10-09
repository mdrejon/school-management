import{A as e,B as t,Dt as n,F as r,Mt as i,O as a,U as o,_ as s,mt as c,v as l,y as u}from"./vue.runtime.esm-bundler-DMNvs-nP.js";import{l as d,u as f}from"./card-U9eiqh39.js";import{f as p}from"./app-BIF8Ft1G.js";var m=p.extend({name:`avatar`,style:`
    .p-avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: dt('avatar.width');
        height: dt('avatar.height');
        font-size: dt('avatar.font.size');
        background: dt('avatar.background');
        color: dt('avatar.color');
        border-radius: dt('avatar.border.radius');
    }

    .p-avatar-image {
        background: transparent;
    }

    .p-avatar-circle {
        border-radius: 50%;
    }

    .p-avatar-circle img {
        border-radius: 50%;
    }

    .p-avatar-icon {
        font-size: dt('avatar.icon.size');
        width: dt('avatar.icon.size');
        height: dt('avatar.icon.size');
    }

    .p-avatar img {
        width: 100%;
        height: 100%;
    }

    .p-avatar-lg {
        width: dt('avatar.lg.width');
        height: dt('avatar.lg.width');
        font-size: dt('avatar.lg.font.size');
    }

    .p-avatar-lg .p-avatar-icon {
        font-size: dt('avatar.lg.icon.size');
        width: dt('avatar.lg.icon.size');
        height: dt('avatar.lg.icon.size');
    }

    .p-avatar-xl {
        width: dt('avatar.xl.width');
        height: dt('avatar.xl.width');
        font-size: dt('avatar.xl.font.size');
    }

    .p-avatar-xl .p-avatar-icon {
        font-size: dt('avatar.xl.icon.size');
        width: dt('avatar.xl.icon.size');
        height: dt('avatar.xl.icon.size');
    }

    .p-avatar-group {
        display: flex;
        align-items: center;
    }

    .p-avatar-group .p-avatar + .p-avatar {
        margin-inline-start: dt('avatar.group.offset');
    }

    .p-avatar-group .p-avatar {
        border: 2px solid dt('avatar.group.border.color');
    }

    .p-avatar-group .p-avatar-lg + .p-avatar-lg {
        margin-inline-start: dt('avatar.lg.group.offset');
    }

    .p-avatar-group .p-avatar-xl + .p-avatar-xl {
        margin-inline-start: dt('avatar.xl.group.offset');
    }
`,classes:{root:function(e){var t=e.props;return[`p-avatar p-component`,{"p-avatar-image":t.image!=null,"p-avatar-circle":t.shape===`circle`,"p-avatar-lg":t.size===`large`,"p-avatar-xl":t.size===`xlarge`}]},label:`p-avatar-label`,icon:`p-avatar-icon`}});a(),c();var h={name:`BaseAvatar`,extends:d,props:{label:{type:String,default:null},icon:{type:String,default:null},image:{type:String,default:null},size:{type:String,default:`normal`},shape:{type:String,default:`square`},ariaLabelledby:{type:String,default:null},ariaLabel:{type:String,default:null}},style:m,provide:function(){return{$pcAvatar:this,$parentInstance:this}}};function g(e){"@babel/helpers - typeof";return g=typeof Symbol==`function`&&typeof Symbol.iterator==`symbol`?function(e){return typeof e}:function(e){return e&&typeof Symbol==`function`&&e.constructor===Symbol&&e!==Symbol.prototype?`symbol`:typeof e},g(e)}function _(e,t,n){return(t=v(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function v(e){var t=y(e,`string`);return g(t)==`symbol`?t:t+``}function y(e,t){if(g(e)!=`object`||!e)return e;var n=e[Symbol.toPrimitive];if(n!==void 0){var r=n.call(e,t);if(g(r)!=`object`)return r;throw TypeError(`@@toPrimitive must return a primitive value.`)}return(t===`string`?String:Number)(e)}var b={name:`Avatar`,extends:h,inheritAttrs:!1,emits:[`error`],methods:{onError:function(e){this.$emit(`error`,e)}},computed:{dataP:function(){return f(_(_({},this.shape,this.shape),this.size,this.size))}}},x=[`aria-labelledby`,`aria-label`,`data-p`],S=[`data-p`],C=[`data-p`],w=[`src`,`alt`,`data-p`];function T(a,c,d,f,p,m){return r(),u(`div`,e({class:a.cx(`root`),"aria-labelledby":a.ariaLabelledby,"aria-label":a.ariaLabel},a.ptmi(`root`),{"data-p":m.dataP}),[t(a.$slots,`default`,{},function(){return[a.label?(r(),u(`span`,e({key:0,class:a.cx(`label`)},a.ptm(`label`),{"data-p":m.dataP}),i(a.label),17,S)):a.$slots.icon?(r(),s(o(a.$slots.icon),{key:1,class:n(a.cx(`icon`))},null,8,[`class`])):a.icon?(r(),u(`span`,e({key:2,class:[a.cx(`icon`),a.icon]},a.ptm(`icon`),{"data-p":m.dataP}),null,16,C)):a.image?(r(),u(`img`,e({key:3,src:a.image,alt:a.ariaLabel,onError:c[0]||=function(){return m.onError&&m.onError.apply(m,arguments)}},a.ptm(`image`),{"data-p":m.dataP}),null,16,w)):l(``,!0)]})],16,x)}b.render=T;export{b as t};