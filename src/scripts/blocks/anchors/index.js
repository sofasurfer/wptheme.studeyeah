import {__} from '@wordpress/i18n';
import {registerBlockType} from '@wordpress/blocks';
import {useBlockProps, InnerBlocks} from '@wordpress/block-editor';
import blockConfig from './block.json';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType(blockConfig, {
  /**
   * @see ./edit.js
   */
  edit: () => {
    const ALLOWED_BLOCKS = ['nf/anchor'];
    const TEMPLATE = [['nf/anchor'], ['nf/anchor'], ['nf/anchor']];

    return (
      <div {...useBlockProps()}>
        <div className={'wp-block-nf-anchors'}>
          <InnerBlocks
            allowedBlocks={ALLOWED_BLOCKS}
            template={TEMPLATE}
          />
        </div>
      </div>
    )
  },
  /**
   * @see ./save.js
   */
  save: () => {
    return (
      <div {...useBlockProps.save()}>
          <InnerBlocks.Content />
      </div>
    )
  },
});
