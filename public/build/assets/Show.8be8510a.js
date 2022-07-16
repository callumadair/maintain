import{_ as c}from"./AppLayout.f3e57163.js";import p from"./DeleteUserForm.bf83ad76.js";import{J as s}from"./SectionBorder.64d4d3c6.js";import l from"./LogoutOtherBrowserSessionsForm.f5cd01a7.js";import f from"./TwoFactorAuthenticationForm.06f8824f.js";import u from"./UpdatePasswordForm.48bcf3bd.js";import _ from"./UpdateProfileInformationForm.a4ad1611.js";import{o,e as d,w as n,a as i,c as r,b as t,i as a,F as h}from"./app.83ed3456.js";import"./plugin-vue_export-helper.21dcd24c.js";import"./DialogModal.e15ddb53.js";import"./InputError.cafacf0a.js";import"./DangerButton.63f3619e.js";import"./Input.1067b2ee.js";import"./SecondaryButton.fc1238c6.js";import"./ActionMessage.8f632407.js";import"./Button.9ed2e117.js";import"./Label.708d93f0.js";import"./FormSection.7062e1fb.js";const g=i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),$={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},M={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(e,x)=>(o(),d(c,{title:"Profile"},{header:n(()=>[g]),default:n(()=>[i("div",null,[i("div",$,[e.$page.props.jetstream.canUpdateProfileInformation?(o(),r("div",w,[t(_,{user:e.$page.props.user},null,8,["user"]),t(s)])):a("",!0),e.$page.props.jetstream.canUpdatePassword?(o(),r("div",k,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(o(),r("div",y,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(o(),r(h,{key:3},[t(s),t(p,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{M as default};
