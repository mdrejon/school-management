<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import IconPicker from '@/Components/Admin/IconPicker.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    settings: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const normalizeInstituteInfo = (items) =>
    (items ?? []).map((item) => ({
        label: { ...emptyTranslatable(), ...item.label },
        value: { ...emptyTranslatable(), ...item.value },
    }));

// Default icon for newly-added repeater rows before the admin picks one —
// a generic Lucide icon, replaced via IconPicker (library search or upload).
const defaultIcon = () => ({ source: 'lucide', value: 'circle' });

const normalizeCtaStats = (items) =>
    (items ?? []).map((item) => ({
        icon: item.icon ?? defaultIcon(),
        value: item.value ?? '',
        label: { ...emptyTranslatable(), ...item.label },
    }));

const normalizePartnerLogos = (items) => (items ?? []).map((item) => ({ image: item.image ?? null }));

const normalizeChooseFeatures = (items) =>
    (items ?? []).map((item) => ({
        icon: item.icon ?? defaultIcon(),
        title: { ...emptyTranslatable(), ...item.title },
        description: { ...emptyTranslatable(), ...item.description },
    }));

const normalizeSkillItems = (items) =>
    (items ?? []).map((item) => ({
        label: { ...emptyTranslatable(), ...item.label },
        percentage: item.percentage ?? '',
    }));

const normalizeAboutItems = (items) =>
    (items ?? []).map((item) => ({
        icon: item.icon ?? defaultIcon(),
        title: { ...emptyTranslatable(), ...item.title },
        description: { ...emptyTranslatable(), ...item.description },
    }));

const sections = [
    { key: 'general', label: 'General', icon: 'pi pi-building', description: 'Site name and logos.' },
    { key: 'header', label: 'Header', icon: 'pi pi-align-left', description: "Address, phone, email, and social links shown in the site header — the footer reuses these too." },
    { key: 'footer', label: 'Footer', icon: 'pi pi-align-justify', description: "The footer's about text and copyright line." },
    { key: 'school', label: 'School Profile', icon: 'pi pi-verified', description: 'Homepage stat strips: institute details under the slider, and the counter/CTA band further down.' },
    { key: 'choose', label: 'Why Choose Us', icon: 'pi pi-check-circle', description: 'The "Why Choose Us" block with feature boxes and a side image.' },
    { key: 'about', label: 'About Us', icon: 'pi pi-info-circle', description: 'The "About Us" block with photos, an experience badge, feature items, and a quote.' },
    { key: 'skill', label: 'Our Skills', icon: 'pi pi-chart-bar', description: 'The enrollment card and "Our Skills" progress bars.' },
    { key: 'video', label: 'Video Section', icon: 'pi pi-video', description: 'The "Latest Video" block further down the homepage.' },
    { key: 'offer', label: 'Offer Banner', icon: 'pi pi-megaphone', description: 'The promotional banner ("Our 20% Offer...") further down the homepage.' },
];
const activeSection = computed(() => sections.find((s) => s.key === activeSectionKey.value));
const activeSectionKey = ref('general');

// One shared language tab across every section — picked once at the top of
// the content area, so every translatable field/card below (across every
// section) reads/writes `activeLang` directly instead of each needing its
// own <Tabs> language switcher.
const activeLang = ref('');
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));

const logoPreview = ref(props.settings.logo_url);
const footerLogoPreview = ref(props.settings.footer_logo_url);
const partnerLogoPreviews = ref(
    normalizePartnerLogos(props.settings.partner_logos).map((item) => (item.image ? `/storage/${item.image}` : null)),
);
const videoThumbnailPreview = ref(props.settings.video_thumbnail_url);
const offerBackgroundPreview = ref(props.settings.offer_background_url);
const chooseImagePreview = ref(props.settings.choose_image_url);
const aboutImage1Preview = ref(props.settings.about_image_1_url);
const aboutImage2Preview = ref(props.settings.about_image_2_url);
const aboutImage3Preview = ref(props.settings.about_image_3_url);

const form = useForm({
    logo: null,
    footer_logo: null,
    site_name: { ...emptyTranslatable(), ...props.settings.site_name },
    address: { ...emptyTranslatable(), ...props.settings.address },
    phone: props.settings.phone ?? '',
    email: props.settings.email ?? '',
    facebook_url: props.settings.facebook_url ?? '',
    instagram_url: props.settings.instagram_url ?? '',
    youtube_url: props.settings.youtube_url ?? '',
    whatsapp_url: props.settings.whatsapp_url ?? '',
    linkedin_url: props.settings.linkedin_url ?? '',
    footer_about: { ...emptyTranslatable(), ...props.settings.footer_about },
    copyright_text: { ...emptyTranslatable(), ...props.settings.copyright_text },
    institute_info: normalizeInstituteInfo(props.settings.institute_info),
    cta_stats: normalizeCtaStats(props.settings.cta_stats),
    partner_logos: normalizePartnerLogos(props.settings.partner_logos),
    video_thumbnail: null,
    video_tagline: { ...emptyTranslatable(), ...props.settings.video_tagline },
    video_title: { ...emptyTranslatable(), ...props.settings.video_title },
    video_highlight: { ...emptyTranslatable(), ...props.settings.video_highlight },
    video_description: { ...emptyTranslatable(), ...props.settings.video_description },
    video_button_text: { ...emptyTranslatable(), ...props.settings.video_button_text },
    video_button_url: props.settings.video_button_url ?? '',
    video_youtube_url: props.settings.video_youtube_url ?? '',
    offer_background: null,
    offer_title: { ...emptyTranslatable(), ...props.settings.offer_title },
    offer_description: { ...emptyTranslatable(), ...props.settings.offer_description },
    offer_button_text: { ...emptyTranslatable(), ...props.settings.offer_button_text },
    offer_button_url: props.settings.offer_button_url ?? '',
    choose_image: null,
    choose_tagline: { ...emptyTranslatable(), ...props.settings.choose_tagline },
    choose_title: { ...emptyTranslatable(), ...props.settings.choose_title },
    choose_highlight: { ...emptyTranslatable(), ...props.settings.choose_highlight },
    choose_description: { ...emptyTranslatable(), ...props.settings.choose_description },
    choose_features: normalizeChooseFeatures(props.settings.choose_features),
    skill_enroll_title: { ...emptyTranslatable(), ...props.settings.skill_enroll_title },
    skill_enroll_subtitle: { ...emptyTranslatable(), ...props.settings.skill_enroll_subtitle },
    skill_tagline: { ...emptyTranslatable(), ...props.settings.skill_tagline },
    skill_title: { ...emptyTranslatable(), ...props.settings.skill_title },
    skill_highlight: { ...emptyTranslatable(), ...props.settings.skill_highlight },
    skill_description: { ...emptyTranslatable(), ...props.settings.skill_description },
    skill_button_text: { ...emptyTranslatable(), ...props.settings.skill_button_text },
    skill_button_url: props.settings.skill_button_url ?? '',
    skill_items: normalizeSkillItems(props.settings.skill_items),
    about_image_1: null,
    about_image_2: null,
    about_image_3: null,
    about_tagline: { ...emptyTranslatable(), ...props.settings.about_tagline },
    about_title: { ...emptyTranslatable(), ...props.settings.about_title },
    about_highlight: { ...emptyTranslatable(), ...props.settings.about_highlight },
    about_description: { ...emptyTranslatable(), ...props.settings.about_description },
    about_quote: { ...emptyTranslatable(), ...props.settings.about_quote },
    about_button_text: { ...emptyTranslatable(), ...props.settings.about_button_text },
    about_button_url: props.settings.about_button_url ?? '',
    about_badge_icon: props.settings.about_badge_icon ?? defaultIcon(),
    about_badge_text: { ...emptyTranslatable(), ...props.settings.about_badge_text },
    about_items: normalizeAboutItems(props.settings.about_items),
});

activeLang.value = defaultLangCode.value;

const onLogoSelected = (file) => {
    form.logo = file;
    form.clearErrors('logo');
    logoPreview.value = URL.createObjectURL(file);
};
const onLogoRemoved = () => {
    form.logo = null;
    logoPreview.value = null;
};

const onFooterLogoSelected = (file) => {
    form.footer_logo = file;
    form.clearErrors('footer_logo');
    footerLogoPreview.value = URL.createObjectURL(file);
};
const onFooterLogoRemoved = () => {
    form.footer_logo = null;
    footerLogoPreview.value = null;
};

const addInstituteInfoItem = () => {
    form.institute_info.push({ label: emptyTranslatable(), value: emptyTranslatable() });
};
const removeInstituteInfoItem = (index) => {
    form.institute_info.splice(index, 1);
};

const addCtaStatItem = () => {
    form.cta_stats.push({ icon: defaultIcon(), value: '', label: emptyTranslatable() });
};
const removeCtaStatItem = (index) => {
    form.cta_stats.splice(index, 1);
};

const addPartnerLogo = () => {
    form.partner_logos.push({ image: null });
    partnerLogoPreviews.value.push(null);
};
const removePartnerLogo = (index) => {
    form.partner_logos.splice(index, 1);
    partnerLogoPreviews.value.splice(index, 1);
};
const onPartnerLogoSelected = (index, file) => {
    form.partner_logos[index].image = file;
    form.clearErrors(`partner_logos.${index}.image`);
    partnerLogoPreviews.value[index] = URL.createObjectURL(file);
};
const onPartnerLogoRemovedImage = (index) => {
    form.partner_logos[index].image = null;
    partnerLogoPreviews.value[index] = null;
};

const onVideoThumbnailSelected = (file) => {
    form.video_thumbnail = file;
    form.clearErrors('video_thumbnail');
    videoThumbnailPreview.value = URL.createObjectURL(file);
};
const onVideoThumbnailRemoved = () => {
    form.video_thumbnail = null;
    videoThumbnailPreview.value = null;
};

const onOfferBackgroundSelected = (file) => {
    form.offer_background = file;
    form.clearErrors('offer_background');
    offerBackgroundPreview.value = URL.createObjectURL(file);
};
const onOfferBackgroundRemoved = () => {
    form.offer_background = null;
    offerBackgroundPreview.value = null;
};

const onChooseImageSelected = (file) => {
    form.choose_image = file;
    form.clearErrors('choose_image');
    chooseImagePreview.value = URL.createObjectURL(file);
};
const onChooseImageRemoved = () => {
    form.choose_image = null;
    chooseImagePreview.value = null;
};

const addChooseFeature = () => {
    form.choose_features.push({ icon: defaultIcon(), title: emptyTranslatable(), description: emptyTranslatable() });
};
const removeChooseFeature = (index) => {
    form.choose_features.splice(index, 1);
};

const addSkillItem = () => {
    form.skill_items.push({ label: emptyTranslatable(), percentage: '' });
};
const removeSkillItem = (index) => {
    form.skill_items.splice(index, 1);
};

const onAboutImageSelected = (field, previewRef, file) => {
    form[field] = file;
    form.clearErrors(field);
    previewRef.value = URL.createObjectURL(file);
};
const onAboutImageRemoved = (field, previewRef) => {
    form[field] = null;
    previewRef.value = null;
};

const addAboutItem = () => {
    form.about_items.push({ icon: defaultIcon(), title: emptyTranslatable(), description: emptyTranslatable() });
};
const removeAboutItem = (index) => {
    form.about_items.splice(index, 1);
};

const submit = () => {
    form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.settings.website.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Website Options">
        <p class="text-sm text-slate-500 mb-6">
            Global content shown across the public site's header and footer.
        </p>

        <div class="flex flex-col md:flex-row gap-6 items-start">
            <!-- section nav -->
            <nav class="w-full md:w-60 shrink-0 md:sticky md:top-6">
                <div class="flex md:flex-col gap-1 overflow-x-auto md:overflow-visible rounded-xl border border-slate-200 bg-white p-1.5 shadow-sm">
                    <button
                        v-for="section in sections"
                        :key="section.key"
                        type="button"
                        class="group flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-left whitespace-nowrap transition-colors w-full"
                        :class="activeSectionKey === section.key
                            ? 'bg-indigo-600 text-white shadow-sm'
                            : 'text-slate-600 hover:bg-slate-100'"
                        @click="activeSectionKey = section.key"
                    >
                        <i
                            :class="[section.icon, activeSectionKey === section.key ? 'text-white' : 'text-slate-400 group-hover:text-slate-500']"
                            class="text-base"
                        />
                        <span class="flex-1 font-medium">{{ section.label }}</span>
                    </button>
                </div>
            </nav>

            <!-- section content -->
            <Card class="w-full flex-1 shadow-sm">
                <template #content>
                    <p class="text-sm text-slate-500 mb-6">{{ activeSection?.description }}</p>

                    <!-- language switcher, shared by every translatable field/card below -->
                    <div class="mb-6 pb-5 border-b border-slate-100">
                        <Tabs v-model:value="activeLang">
                            <TabList>
                                <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                            </TabList>
                        </Tabs>
                    </div>

                    <!-- General -->
                    <div v-show="activeSectionKey === 'general'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Site name</h3>
                            <div class="max-w-md">
                                <InputText
                                    v-model="form.site_name[activeLang]"
                                    :dir="currentLang?.direction"
                                    class="w-full"
                                    :placeholder="currentLang?.is_default ? 'Required' : 'Optional'"
                                />
                                <p v-if="form.errors[`site_name.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`site_name.${activeLang}`] }}</p>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Logos</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Header logo</label>
                                    <ImageDropzone
                                        :preview-url="logoPreview"
                                        hint="Drag & drop a logo, or click to browse"
                                        width-class="w-full sm:w-64" height-class="h-32"
                                        @select="onLogoSelected"
                                        @remove="onLogoRemoved"
                                    />
                                    <p v-if="form.errors.logo" class="text-xs text-red-500 mt-1">{{ form.errors.logo }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Footer logo</label>
                                    <ImageDropzone
                                        :preview-url="footerLogoPreview"
                                        hint="Optional — falls back to header logo"
                                        width-class="w-full sm:w-64" height-class="h-32"
                                        @select="onFooterLogoSelected"
                                        @remove="onFooterLogoRemoved"
                                    />
                                    <p v-if="form.errors.footer_logo" class="text-xs text-red-500 mt-1">{{ form.errors.footer_logo }}</p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Header (contact + social) -->
                    <div v-show="activeSectionKey === 'header'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Address</h3>
                            <div class="max-w-md">
                                <InputText v-model="form.address[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="City, Country" />
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Contact details</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Phone</label>
                                    <InputText v-model="form.phone" class="w-full" placeholder="+880 1712-345678" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Email</label>
                                    <InputText v-model="form.email" class="w-full" placeholder="info@example.com" />
                                    <p v-if="form.errors.email" class="text-xs text-red-500 mt-1">{{ form.errors.email }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Social links</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5"><i class="pi pi-facebook mr-1" />Facebook</label>
                                    <InputText v-model="form.facebook_url" class="w-full" placeholder="https://facebook.com/..." />
                                    <p v-if="form.errors.facebook_url" class="text-xs text-red-500 mt-1">{{ form.errors.facebook_url }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5"><i class="pi pi-instagram mr-1" />Instagram</label>
                                    <InputText v-model="form.instagram_url" class="w-full" placeholder="https://instagram.com/..." />
                                    <p v-if="form.errors.instagram_url" class="text-xs text-red-500 mt-1">{{ form.errors.instagram_url }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5"><i class="pi pi-youtube mr-1" />YouTube</label>
                                    <InputText v-model="form.youtube_url" class="w-full" placeholder="https://youtube.com/..." />
                                    <p v-if="form.errors.youtube_url" class="text-xs text-red-500 mt-1">{{ form.errors.youtube_url }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5"><i class="pi pi-whatsapp mr-1" />WhatsApp</label>
                                    <InputText v-model="form.whatsapp_url" class="w-full" placeholder="https://wa.me/..." />
                                    <p v-if="form.errors.whatsapp_url" class="text-xs text-red-500 mt-1">{{ form.errors.whatsapp_url }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5"><i class="pi pi-linkedin mr-1" />LinkedIn</label>
                                    <InputText v-model="form.linkedin_url" class="w-full" placeholder="https://linkedin.com/..." />
                                    <p v-if="form.errors.linkedin_url" class="text-xs text-red-500 mt-1">{{ form.errors.linkedin_url }}</p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Footer -->
                    <div v-show="activeSectionKey === 'footer'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">About text &amp; copyright</h3>
                            <div class="max-w-lg">
                                <div class="flex flex-col gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">About text</label>
                                        <Textarea v-model="form.footer_about[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">Copyright line</label>
                                        <InputText v-model="form.copyright_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="All Rights Reserved." />
                                    </div>
                                </div>
                                <p class="text-xs text-slate-400 mt-3">
                                    Copyright line is shown at the end, e.g. "© 2026 {{ form.site_name[defaultLangCode] || 'Your School' }} — {{ form.copyright_text[defaultLangCode] || 'All Rights Reserved.' }}"
                                </p>
                            </div>
                        </section>
                    </div>

                    <!-- School Profile -->
                    <div v-show="activeSectionKey === 'school'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-semibold text-slate-800">Institute details</h3>
                                <Button label="Add item" icon="pi pi-plus" text size="small" @click="addInstituteInfoItem" />
                            </div>

                            <p v-if="!form.institute_info.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                            <div v-else class="flex flex-col gap-3">
                                <div
                                    v-for="(item, index) in form.institute_info"
                                    :key="index"
                                    class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3 sm:items-start rounded-lg border border-slate-100 p-3"
                                >
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Label</label>
                                        <InputText
                                            v-model="item.label[activeLang]"
                                            :dir="currentLang?.direction"
                                            class="w-full"
                                            :placeholder="currentLang?.is_default ? 'Required, e.g. Institute EIIN' : 'Optional'"
                                        />
                                        <p v-if="form.errors[`institute_info.${index}.label.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`institute_info.${index}.label.${activeLang}`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Value</label>
                                        <InputText
                                            v-model="item.value[activeLang]"
                                            :dir="currentLang?.direction"
                                            class="w-full"
                                            :placeholder="currentLang?.is_default ? 'Required, e.g. 123456' : 'Optional'"
                                        />
                                        <p v-if="form.errors[`institute_info.${index}.value.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`institute_info.${index}.value.${activeLang}`] }}</p>
                                    </div>
                                    <div class="flex sm:justify-end sm:pt-6">
                                        <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeInstituteInfoItem(index)" />
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-semibold text-slate-800">CTA section</h3>
                                <Button label="Add item" icon="pi pi-plus" text size="small" @click="addCtaStatItem" />
                            </div>
                            <p class="text-xs text-slate-400 mb-3">The counter strip shown further down the homepage (icon, number, and label — e.g. "500 + Total Courses").</p>

                            <p v-if="!form.cta_stats.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                            <div v-else class="flex flex-col gap-3">
                                <div
                                    v-for="(item, index) in form.cta_stats"
                                    :key="index"
                                    class="grid grid-cols-1 sm:grid-cols-[auto_auto_1fr_auto] gap-3 sm:items-start rounded-lg border border-slate-100 p-3"
                                >
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Icon</label>
                                        <IconPicker v-model="item.icon" />
                                        <p v-if="form.errors[`cta_stats.${index}.icon.value`]" class="text-xs text-red-500 mt-1">{{ form.errors[`cta_stats.${index}.icon.value`] }}</p>
                                    </div>
                                    <div class="sm:w-28">
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Number</label>
                                        <InputText v-model="item.value" class="w-full" placeholder="500" />
                                        <p v-if="form.errors[`cta_stats.${index}.value`]" class="text-xs text-red-500 mt-1">{{ form.errors[`cta_stats.${index}.value`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Label</label>
                                        <InputText
                                            v-model="item.label[activeLang]"
                                            :dir="currentLang?.direction"
                                            class="w-full"
                                            :placeholder="currentLang?.is_default ? 'Required, e.g. Total Courses' : 'Optional'"
                                        />
                                        <p v-if="form.errors[`cta_stats.${index}.label.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`cta_stats.${index}.label.${activeLang}`] }}</p>
                                    </div>
                                    <div class="flex sm:justify-end sm:pt-6">
                                        <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeCtaStatItem(index)" />
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-semibold text-slate-800">Partner logos</h3>
                                <Button label="Add logo" icon="pi pi-plus" text size="small" @click="addPartnerLogo" />
                            </div>
                            <p class="text-xs text-slate-400 mb-3">Logo strip shown near the footer.</p>

                            <p v-if="!form.partner_logos.length" class="text-sm text-slate-400">No logos yet — add one above.</p>
                            <div v-else class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                <div v-for="(_, index) in form.partner_logos" :key="index" class="relative">
                                    <button
                                        type="button"
                                        class="absolute -top-2 -right-2 z-10 size-6 rounded-full bg-white border border-slate-200 shadow flex items-center justify-center text-red-500 hover:bg-red-50"
                                        aria-label="Remove logo"
                                        @click="removePartnerLogo(index)"
                                    >
                                        <i class="pi pi-times text-xs" />
                                    </button>
                                    <ImageDropzone
                                        :preview-url="partnerLogoPreviews[index]"
                                        hint="Logo"
                                        width-class="w-full" height-class="h-24"
                                        @select="(file) => onPartnerLogoSelected(index, file)"
                                        @remove="() => onPartnerLogoRemovedImage(index)"
                                    />
                                    <p v-if="form.errors[`partner_logos.${index}.image`]" class="text-xs text-red-500 mt-1">{{ form.errors[`partner_logos.${index}.image`] }}</p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Why Choose Us -->
                    <div v-show="activeSectionKey === 'choose'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Content</h3>
                            <div class="flex flex-col gap-4 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                    <InputText v-model="form.choose_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Why Choose Us" />
                                    <p v-if="form.errors[`choose_tagline.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`choose_tagline.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                    <InputText v-model="form.choose_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. We Are Expert & Do Our Best For Your Goal" />
                                    <p v-if="form.errors[`choose_title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`choose_title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlighted words</label>
                                    <InputText v-model="form.choose_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Do Our Best" />
                                    <p class="text-xs text-slate-400 mt-1">The words within Title to show in orange — must match exactly.</p>
                                    <p v-if="form.errors[`choose_highlight.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`choose_highlight.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                    <Textarea v-model="form.choose_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                    <p v-if="form.errors[`choose_description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`choose_description.${activeLang}`] }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Side image</h3>
                            <div class="max-w-xs">
                                <ImageDropzone
                                    :preview-url="chooseImagePreview"
                                    hint="Photo shown next to the feature boxes"
                                    width-class="w-full" height-class="h-32"
                                    @select="onChooseImageSelected"
                                    @remove="onChooseImageRemoved"
                                />
                                <p v-if="form.errors.choose_image" class="text-xs text-red-500 mt-1">{{ form.errors.choose_image }}</p>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-semibold text-slate-800">Feature boxes</h3>
                                <Button label="Add item" icon="pi pi-plus" text size="small" @click="addChooseFeature" />
                            </div>

                            <p v-if="!form.choose_features.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                            <div v-else class="flex flex-col gap-3">
                                <div
                                    v-for="(item, index) in form.choose_features"
                                    :key="index"
                                    class="grid grid-cols-1 sm:grid-cols-[auto_1fr_1fr_auto] gap-3 sm:items-start rounded-lg border border-slate-100 p-3"
                                >
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Icon</label>
                                        <IconPicker v-model="item.icon" />
                                        <p v-if="form.errors[`choose_features.${index}.icon.value`]" class="text-xs text-red-500 mt-1">{{ form.errors[`choose_features.${index}.icon.value`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                        <InputText
                                            v-model="item.title[activeLang]"
                                            :dir="currentLang?.direction"
                                            class="w-full"
                                            :placeholder="currentLang?.is_default ? 'Required, e.g. Expert Teachers' : 'Optional'"
                                        />
                                        <p v-if="form.errors[`choose_features.${index}.title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`choose_features.${index}.title.${activeLang}`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                        <InputText
                                            v-model="item.description[activeLang]"
                                            :dir="currentLang?.direction"
                                            class="w-full"
                                            :placeholder="currentLang?.is_default ? 'Required' : 'Optional'"
                                        />
                                        <p v-if="form.errors[`choose_features.${index}.description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`choose_features.${index}.description.${activeLang}`] }}</p>
                                    </div>
                                    <div class="flex sm:justify-end sm:pt-6">
                                        <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeChooseFeature(index)" />
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- About Us -->
                    <div v-show="activeSectionKey === 'about'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Content</h3>
                            <div class="flex flex-col gap-4 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                    <InputText v-model="form.about_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. About Us" />
                                    <p v-if="form.errors[`about_tagline.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_tagline.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                    <InputText v-model="form.about_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Our WexNix Tion System Inspires You More." />
                                    <p v-if="form.errors[`about_title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlighted word</label>
                                    <InputText v-model="form.about_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Inspires" />
                                    <p class="text-xs text-slate-400 mt-1">The word within Title to show in orange — must match exactly.</p>
                                    <p v-if="form.errors[`about_highlight.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_highlight.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                    <Textarea v-model="form.about_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                    <p v-if="form.errors[`about_description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_description.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Quote</label>
                                    <Textarea v-model="form.about_quote[activeLang]" :dir="currentLang?.direction" rows="2" class="w-full" />
                                    <p v-if="form.errors[`about_quote.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_quote.${activeLang}`] }}</p>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Button text</label>
                                        <InputText v-model="form.about_button_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Discover More" />
                                        <p v-if="form.errors[`about_button_text.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_button_text.${activeLang}`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Button link</label>
                                        <InputText v-model="form.about_button_url" class="w-full" placeholder="https://... or #" />
                                        <p v-if="form.errors.about_button_url" class="text-xs text-red-500 mt-1">{{ form.errors.about_button_url }}</p>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-400">The "Call Now" number reuses the phone set under General → Header.</p>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Experience badge</h3>
                            <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Icon</label>
                                    <IconPicker v-model="form.about_badge_icon" />
                                    <p v-if="form.errors['about_badge_icon.value']" class="text-xs text-red-500 mt-1">{{ form.errors['about_badge_icon.value'] }}</p>
                                </div>
                                <div class="flex-1 max-w-sm">
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Text</label>
                                    <InputText v-model="form.about_badge_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. 30 Years Of Quality Service" />
                                    <p v-if="form.errors[`about_badge_text.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_badge_text.${activeLang}`] }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Photos</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Photo 1</label>
                                    <ImageDropzone
                                        :preview-url="aboutImage1Preview"
                                        hint="Large portrait photo"
                                        width-class="w-full" height-class="h-40"
                                        @select="(file) => onAboutImageSelected('about_image_1', aboutImage1Preview, file)"
                                        @remove="() => onAboutImageRemoved('about_image_1', aboutImage1Preview)"
                                    />
                                    <p v-if="form.errors.about_image_1" class="text-xs text-red-500 mt-1">{{ form.errors.about_image_1 }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Photo 2</label>
                                    <ImageDropzone
                                        :preview-url="aboutImage2Preview"
                                        hint="Top-right photo"
                                        width-class="w-full" height-class="h-40"
                                        @select="(file) => onAboutImageSelected('about_image_2', aboutImage2Preview, file)"
                                        @remove="() => onAboutImageRemoved('about_image_2', aboutImage2Preview)"
                                    />
                                    <p v-if="form.errors.about_image_2" class="text-xs text-red-500 mt-1">{{ form.errors.about_image_2 }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Photo 3</label>
                                    <ImageDropzone
                                        :preview-url="aboutImage3Preview"
                                        hint="Bottom-right photo"
                                        width-class="w-full" height-class="h-40"
                                        @select="(file) => onAboutImageSelected('about_image_3', aboutImage3Preview, file)"
                                        @remove="() => onAboutImageRemoved('about_image_3', aboutImage3Preview)"
                                    />
                                    <p v-if="form.errors.about_image_3" class="text-xs text-red-500 mt-1">{{ form.errors.about_image_3 }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-semibold text-slate-800">Feature items</h3>
                                <Button label="Add item" icon="pi pi-plus" text size="small" @click="addAboutItem" />
                            </div>

                            <p v-if="!form.about_items.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                            <div v-else class="flex flex-col gap-3">
                                <div
                                    v-for="(item, index) in form.about_items"
                                    :key="index"
                                    class="grid grid-cols-1 sm:grid-cols-[auto_1fr_1fr_auto] gap-3 sm:items-start rounded-lg border border-slate-100 p-3"
                                >
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Icon</label>
                                        <IconPicker v-model="item.icon" />
                                        <p v-if="form.errors[`about_items.${index}.icon.value`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_items.${index}.icon.value`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                        <InputText
                                            v-model="item.title[activeLang]"
                                            :dir="currentLang?.direction"
                                            class="w-full"
                                            :placeholder="currentLang?.is_default ? 'Required, e.g. International Hubs' : 'Optional'"
                                        />
                                        <p v-if="form.errors[`about_items.${index}.title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_items.${index}.title.${activeLang}`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                        <InputText
                                            v-model="item.description[activeLang]"
                                            :dir="currentLang?.direction"
                                            class="w-full"
                                            :placeholder="currentLang?.is_default ? 'Required' : 'Optional'"
                                        />
                                        <p v-if="form.errors[`about_items.${index}.description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`about_items.${index}.description.${activeLang}`] }}</p>
                                    </div>
                                    <div class="flex sm:justify-end sm:pt-6">
                                        <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeAboutItem(index)" />
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Our Skills -->
                    <div v-show="activeSectionKey === 'skill'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Enrollment card</h3>
                            <div class="flex flex-col gap-4 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                    <InputText v-model="form.skill_enroll_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Start Your Enrollment" />
                                    <p v-if="form.errors[`skill_enroll_title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_enroll_title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Subtitle</label>
                                    <InputText v-model="form.skill_enroll_subtitle[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                    <p v-if="form.errors[`skill_enroll_subtitle.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_enroll_subtitle.${activeLang}`] }}</p>
                                </div>
                                <p class="text-xs text-slate-400">The form fields below it (name, email, course, message) are fixed theme UI, not editable here.</p>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Content</h3>
                            <div class="flex flex-col gap-4 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                    <InputText v-model="form.skill_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Our Skills" />
                                    <p v-if="form.errors[`skill_tagline.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_tagline.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                    <InputText v-model="form.skill_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Explore Your Creativity And Talent With Us" />
                                    <p v-if="form.errors[`skill_title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlighted words</label>
                                    <InputText v-model="form.skill_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Creativity And Talent" />
                                    <p class="text-xs text-slate-400 mt-1">The words within Title to show in orange — must match exactly.</p>
                                    <p v-if="form.errors[`skill_highlight.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_highlight.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                    <Textarea v-model="form.skill_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                    <p v-if="form.errors[`skill_description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_description.${activeLang}`] }}</p>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Button text</label>
                                        <InputText v-model="form.skill_button_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Learn More" />
                                        <p v-if="form.errors[`skill_button_text.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_button_text.${activeLang}`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Button link</label>
                                        <InputText v-model="form.skill_button_url" class="w-full" placeholder="https://... or #" />
                                        <p v-if="form.errors.skill_button_url" class="text-xs text-red-500 mt-1">{{ form.errors.skill_button_url }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-semibold text-slate-800">Skill bars</h3>
                                <Button label="Add item" icon="pi pi-plus" text size="small" @click="addSkillItem" />
                            </div>

                            <p v-if="!form.skill_items.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                            <div v-else class="flex flex-col gap-3">
                                <div
                                    v-for="(item, index) in form.skill_items"
                                    :key="index"
                                    class="grid grid-cols-1 sm:grid-cols-[1fr_auto_auto] gap-3 sm:items-start rounded-lg border border-slate-100 p-3"
                                >
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Label</label>
                                        <InputText
                                            v-model="item.label[activeLang]"
                                            :dir="currentLang?.direction"
                                            class="w-full"
                                            :placeholder="currentLang?.is_default ? 'Required, e.g. Our Students' : 'Optional'"
                                        />
                                        <p v-if="form.errors[`skill_items.${index}.label.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_items.${index}.label.${activeLang}`] }}</p>
                                    </div>
                                    <div class="sm:w-24">
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Percent</label>
                                        <InputText v-model="item.percentage" class="w-full" placeholder="85" />
                                        <p v-if="form.errors[`skill_items.${index}.percentage`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skill_items.${index}.percentage`] }}</p>
                                    </div>
                                    <div class="flex sm:justify-end sm:pt-6">
                                        <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeSkillItem(index)" />
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Video Section -->
                    <div v-show="activeSectionKey === 'video'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Content</h3>
                            <div class="flex flex-col gap-4 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                    <InputText v-model="form.video_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Latest Video" />
                                    <p v-if="form.errors[`video_tagline.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`video_tagline.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                    <InputText v-model="form.video_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Let's Check Our Latest Video" />
                                    <p v-if="form.errors[`video_title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`video_title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlighted word</label>
                                    <InputText v-model="form.video_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Latest" />
                                    <p class="text-xs text-slate-400 mt-1">The word within Title to show in orange — must match exactly.</p>
                                    <p v-if="form.errors[`video_highlight.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`video_highlight.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                    <Textarea v-model="form.video_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                    <p v-if="form.errors[`video_description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`video_description.${activeLang}`] }}</p>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Button text</label>
                                        <InputText v-model="form.video_button_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Learn More" />
                                        <p v-if="form.errors[`video_button_text.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`video_button_text.${activeLang}`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Button link</label>
                                        <InputText v-model="form.video_button_url" class="w-full" placeholder="https://... or #" />
                                        <p v-if="form.errors.video_button_url" class="text-xs text-red-500 mt-1">{{ form.errors.video_button_url }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Video</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Thumbnail</label>
                                    <ImageDropzone
                                        :preview-url="videoThumbnailPreview"
                                        hint="Background image behind the play button"
                                        width-class="w-full" height-class="h-32"
                                        @select="onVideoThumbnailSelected"
                                        @remove="onVideoThumbnailRemoved"
                                    />
                                    <p v-if="form.errors.video_thumbnail" class="text-xs text-red-500 mt-1">{{ form.errors.video_thumbnail }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">YouTube URL</label>
                                    <InputText v-model="form.video_youtube_url" class="w-full" placeholder="https://www.youtube.com/watch?v=..." />
                                    <p v-if="form.errors.video_youtube_url" class="text-xs text-red-500 mt-1">{{ form.errors.video_youtube_url }}</p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Offer Banner -->
                    <div v-show="activeSectionKey === 'offer'" class="flex flex-col gap-5">
                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Content</h3>
                            <div class="flex flex-col gap-4 max-w-lg">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                    <InputText v-model="form.offer_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Our 20% Offer Running - Join Today For Your Course" />
                                    <p v-if="form.errors[`offer_title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`offer_title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                    <Textarea v-model="form.offer_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                    <p v-if="form.errors[`offer_description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`offer_description.${activeLang}`] }}</p>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Button text</label>
                                        <InputText v-model="form.offer_button_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Apply Now" />
                                        <p v-if="form.errors[`offer_button_text.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`offer_button_text.${activeLang}`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Button link</label>
                                        <InputText v-model="form.offer_button_url" class="w-full" placeholder="https://... or #" />
                                        <p v-if="form.errors.offer_button_url" class="text-xs text-red-500 mt-1">{{ form.errors.offer_button_url }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-800 mb-3">Background image</h3>
                            <div class="max-w-xs">
                                <ImageDropzone
                                    :preview-url="offerBackgroundPreview"
                                    hint="Full-width photo behind the banner"
                                    width-class="w-full" height-class="h-32"
                                    @select="onOfferBackgroundSelected"
                                    @remove="onOfferBackgroundRemoved"
                                />
                                <p v-if="form.errors.offer_background" class="text-xs text-red-500 mt-1">{{ form.errors.offer_background }}</p>
                            </div>
                        </section>
                    </div>

                    <div class="mt-8 pt-5 border-t border-slate-200 flex justify-end">
                        <Button label="Save Changes" icon="pi pi-check" :loading="form.processing" @click="submit" />
                    </div>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
