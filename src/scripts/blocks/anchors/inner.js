import {__} from '@wordpress/i18n';
import {registerBlockType} from '@wordpress/blocks';
import {
  useBlockProps,
  RichText,
  URLInput,
  InspectorControls,
} from '@wordpress/block-editor';

import {
  PanelBody,
} from '@wordpress/components';
import blockConfig from './inner-block.json';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType(blockConfig, {
  /**
   * @see ./edit.js
   */
  edit: ({attributes, setAttributes}) => {
    const {preTitle, title, link} = attributes;

    return (
      <>
        <InspectorControls>
          <PanelBody title={__('Link', 'neofluxe')}>
            <URLInput
              label={__('URL', 'neofluxe')}
              value={link}
              placeholder={__('Link eingeben', 'neofluxe')}
              onChange={(value) => setAttributes({link: value})}
            />
          </PanelBody>
        </InspectorControls>
        <div {...useBlockProps()}>
          <div className={'wp-block-nf-anchor'}>
            <RichText
              tagName="p"
              placeholder={__('Titel', 'neofluxe')}
              className={'pretitle is-style-caption'}
              value={preTitle}
              onChange={(value) => setAttributes({preTitle: value})}
            />
            <RichText
              tagName="h6"
              className={'title'}
              placeholder={__('Titel', 'neofluxe')}
              value={title}
              onChange={(value) => setAttributes({title: value})}
            />
          </div>
        </div>
      </>
    )
  },
  /**
   * @see ./save.js
   */
  save: ({attributes}) => {
    const {preTitle, title, link} = attributes;

    return (
      <div {...useBlockProps.save()}>
        <RichText.Content
          tagName="p"
          className={'pretitle is-style-caption'}
          value={preTitle}
        />
        <RichText.Content
          tagName="h6"
          className={'title'}
          value={title}
        />
        <a className={'overlay-link'} href={link}></a>
      </div>
    )
  },
});
