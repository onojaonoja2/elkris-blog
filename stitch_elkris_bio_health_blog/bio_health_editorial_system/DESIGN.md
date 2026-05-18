---
name: Bio-Health Editorial System
colors:
  surface: '#f9f9f7'
  surface-dim: '#dadad8'
  surface-bright: '#f9f9f7'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f4f4f1'
  surface-container: '#eeeeec'
  surface-container-high: '#e8e8e6'
  surface-container-highest: '#e2e3e0'
  on-surface: '#1a1c1b'
  on-surface-variant: '#404943'
  inverse-surface: '#2f3130'
  inverse-on-surface: '#f1f1ef'
  outline: '#717973'
  outline-variant: '#c0c9c1'
  surface-tint: '#356850'
  primary: '#002819'
  on-primary: '#ffffff'
  primary-container: '#06402b'
  on-primary-container: '#77ac90'
  inverse-primary: '#9cd2b5'
  secondary: '#086878'
  on-secondary: '#ffffff'
  secondary-container: '#a1ebfe'
  on-secondary-container: '#136c7d'
  tertiary: '#1e2323'
  on-tertiary: '#ffffff'
  tertiary-container: '#333939'
  on-tertiary-container: '#9da2a1'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#b8efd0'
  primary-fixed-dim: '#9cd2b5'
  on-primary-fixed: '#002114'
  on-primary-fixed-variant: '#1b503a'
  secondary-fixed: '#a9edff'
  secondary-fixed-dim: '#87d2e4'
  on-secondary-fixed: '#001f26'
  on-secondary-fixed-variant: '#004e5b'
  tertiary-fixed: '#dee3e3'
  tertiary-fixed-dim: '#c2c7c7'
  on-tertiary-fixed: '#171d1c'
  on-tertiary-fixed-variant: '#424847'
  background: '#f9f9f7'
  on-background: '#1a1c1b'
  surface-variant: '#e2e3e0'
typography:
  display-lg:
    fontFamily: Inter
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.3'
  headline-sm:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
  article-body:
    fontFamily: Merriweather
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.8'
  article-body-mobile:
    fontFamily: Merriweather
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.7'
  ui-label:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '500'
    lineHeight: '1'
    letterSpacing: 0.02em
  caption:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '400'
    lineHeight: '1.4'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  container-max: 1280px
  gutter: 24px
  margin-desktop: 64px
  margin-mobile: 20px
  section-gap: 80px
---

## Brand & Style

The brand identity centers on "Scientific Vitality"—a bridge between rigorous bio-clinical data and holistic wellness. The target audience includes health-conscious professionals and patients seeking credible, evidence-based lifestyle guidance. 

The design style is **Corporate Modern** with a lean toward **Minimalism**. It prioritizes clarity and breathability to reduce cognitive load, essential for complex medical topics. The aesthetic must feel "clinical" through precise alignment and systematic hierarchy, yet "accessible" through soft shadows and organic color tones. High-quality imagery of botanicals, laboratory settings, and diverse lifestyles should be used to ground the digital experience in reality.

## Colors

The palette is anchored by **Deep Forest Green** (#06402B), evoking growth, stability, and premium medical expertise. **Calming Teal** (#2D7D8E) serves as the primary action color, providing a professional yet soothing contrast for links and interactive elements. 

The background utilizes **Crisp Whites** (#FFFFFF) and a **Soft Mint Tint** (#F4F9F8) for section differentiation. For text, a near-black **Deep Charcoal** (#1A1C1B) is used instead of pure black to improve long-form readability and maintain a modern, sophisticated feel. Success, warning, and error states should utilize desaturated versions of green, amber, and red to maintain the calming atmosphere.

## Typography

This design system employs a dual-font strategy to balance utility and immersion. **Inter** is the functional workhorse, used for headlines, navigation, and UI labels to provide a clean, modern, and clinical structure. 

**Merriweather** is reserved strictly for the article body and long-form editorial content. Its tall x-height and sturdy serifs ensure exceptional legibility during deep-reading sessions. To maintain a modern feel, avoid overly tight line spacing; the 1.8 line-height for body text is critical for creating an "accessible" reading experience.

## Layout & Spacing

The layout follows a **Fixed Grid** model on desktop (12 columns) with a maximum container width of 1280px. On mobile, it transitions to a single-column fluid layout with generous horizontal margins to prevent content from feeling cramped.

A strict 8px spacing scale is used to define rhythmic verticality. Large "breathing spaces" (80px+) are used between major content sections (e.g., between the Hero area and the Article Grid) to reinforce the premium, calm brand positioning. Components should prioritize internal padding over external margins to maintain a "contained" and organized clinical appearance.

## Elevation & Depth

Hierarchy is achieved through **Ambient Shadows** and tonal layering. Shadows should be ultra-diffused, using the Primary Deep Green as a very low-opacity tint (e.g., 4-8% opacity) rather than neutral grey. This adds a subtle organic warmth to the "clinical" interface.

Surface levels are defined as:
1.  **Base (Level 0):** Pure White (#FFFFFF) or Mint Tint (#F4F9F8).
2.  **Cards (Level 1):** White background with a 1px soft border (#E6EEEC) and a subtle 12px blur shadow.
3.  **Overlays/Modals (Level 2):** White background with a more pronounced 24px blur shadow to indicate clear separation from the content layer.

## Shapes

The shape language is **Rounded**, utilizing a 0.5rem (8px) base radius. This softens the clinical precision of the Inter typeface, making the brand feel approachable and friendly. 

Buttons and input fields should strictly adhere to this radius. Interactive "Chips" (e.g., for article categories like "Nutrition" or "Bio-Tech") should use a **Pill-shape** (fully rounded) to distinguish them as secondary interactive elements from the primary rectangular CTA buttons.

## Components

### Buttons
- **Primary:** Deep Forest Green background with White text. 8px corner radius. Subtle hover state involves a slight shift toward the Teal color.
- **Secondary:** Teal border (2px) with Teal text. Ghost background.
- **Text Link:** Teal with a thin underline on hover.

### Cards
- Article cards feature a top-aligned image, followed by a pill-shaped category chip and the Inter headline. The card container has a subtle shadow and 16px corner radius (rounded-lg).

### Input Fields
- Structured with a 1px border (#CDD8D6). On focus, the border thickens and changes to Teal. Labels are always positioned above the field in Inter (ui-label).

### Lists & Citations
- Within articles, bulleted lists should use custom checkmark icons in Teal to reinforce the "health check" metaphor. 
- Citations and medical footnotes should use the "caption" style, aligned to a clean vertical rule on the left to denote expert sourcing.

### Progress Indicators
- For long-form articles, a thin Teal progress bar at the top of the viewport provides a modern utility for readers to track their progress.