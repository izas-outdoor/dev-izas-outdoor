<?php return array (
  'arguments' => 
  array (
    'AdobeStock\\Api\\Request\\LicenseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\AdobeStock\\Api\\Request\\License',
      ),
    ),
    'AlternativeSourceProcessors' => 
    array (
      'filenameResolver' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Asset\\PreProcessor\\MinificationFilenameResolver',
      ),
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'lockerProcess' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Asset\\LockerProcess',
      ),
      'sorter' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Asset\\PreProcessor\\Helper\\Sort',
      ),
      'assetBuilder' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Asset\\PreProcessor\\AlternativeSource\\AssetBuilder',
      ),
      'lockName' => 
      array (
        '_v_' => 'alternative-source-css',
      ),
      'alternatives' => 
      array (
        '_v_' => 
        array (
          'less' => 
          array (
            'class' => 'Magento\\Framework\\Css\\PreProcessor\\Adapter\\Less\\Processor',
          ),
        ),
      ),
    ),
    'AmXmlSitemapGridFilterPool' => 
    array (
      'appliers' => 
      array (
        '_vac_' => 
        array (
          'regular' => 
          array (
            '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\RegularFilter',
          ),
          'fulltext' => 
          array (
            '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\FulltextFilter',
          ),
          'mirakl_seller_order_source' => 
          array (
            '_i_' => 'MiraklSeller\\Sales\\Ui\\Component\\View\\Element\\DataProvider\\OrderSourceFilter',
          ),
        ),
      ),
    ),
    'AmXmlitemapSitemapGridDataProvider' => 
    array (
      'name' => 
      array (
        '_vn_' => true,
      ),
      'primaryFieldName' => 
      array (
        '_vn_' => true,
      ),
      'requestFieldName' => 
      array (
        '_vn_' => true,
      ),
      'reporting' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\Reporting',
      ),
      'searchCriteriaBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\Search\\SearchCriteriaBuilder',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'filterBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\FilterBuilder',
      ),
      'meta' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Base\\Block\\Adminhtml\\Import' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Base\\Block\\Adminhtml\\Messages' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'messageManager' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\AdminNotification\\Messages',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Base\\Block\\Info' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'cronFactory' => 
      array (
        '_i_' => 'Magento\\Cron\\Model\\ResourceModel\\Schedule\\CollectionFactory',
      ),
      'directoryList' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Filesystem\\DirectoryList',
      ),
      'reader' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\DeploymentConfig\\Reader',
      ),
      'resourceConnection' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ResourceConnection\\Interceptor',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Base\\Block\\MenuGroup' => 
    array (
      'metadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Base\\Block\\Search' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Base\\Component\\ComponentRegistrar' => 
    array (
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'samples' => 
      array (
        '_i_' => 'Magento\\Framework\\DataObject',
      ),
    ),
    'Amasty\\Base\\Controller\\Adminhtml\\Import\\Download' => 
    array (
      'reader' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Dir\\Reader',
      ),
      'readFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem\\Directory\\ReadFactory',
      ),
      'fileFactory' => 
      array (
        '_i_' => 'Magento\\Backend\\App\\Response\\Http\\FileFactory',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'messageManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Message\\Manager',
      ),
      'resultFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Controller\\ResultFactory',
      ),
    ),
    'Amasty\\Base\\Cron\\RefreshFeedData' => 
    array (
      'adsFeed' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedTypes\\Ads',
      ),
      'extensionsFeed' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedTypes\\Extensions',
      ),
    ),
    'Amasty\\Base\\Debug\\Log' => NULL,
    'Amasty\\Base\\Debug\\System\\AmastyDump' => NULL,
    'Amasty\\Base\\Debug\\System\\AmastyFormatter' => 
    array (
      'format' => 
      array (
        '_vn_' => true,
      ),
      'dateFormat' => 
      array (
        '_vn_' => true,
      ),
      'allowInlineLineBreaks' => 
      array (
        '_v_' => false,
      ),
      'ignoreEmptyContextAndExtra' => 
      array (
        '_v_' => false,
      ),
    ),
    'Amasty\\Base\\Debug\\System\\Beautifier' => NULL,
    'Amasty\\Base\\Debug\\System\\LogBeautifier' => NULL,
    'Amasty\\Base\\Debug\\System\\Template' => NULL,
    'Amasty\\Base\\Debug\\VarDie' => NULL,
    'Amasty\\Base\\Debug\\VarDump' => NULL,
    'Amasty\\Base\\Exceptions\\EntityTypeCodeNotSet' => 
    array (
      'phrase' => 
      array (
        '_vn_' => true,
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
    ),
    'Amasty\\Base\\Exceptions\\MappingColumnDoesntExist' => 
    array (
      'phrase' => 
      array (
        '_vn_' => true,
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
    ),
    'Amasty\\Base\\Exceptions\\MasterAttributeCodeDoesntSet' => 
    array (
      'phrase' => 
      array (
        '_vn_' => true,
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
    ),
    'Amasty\\Base\\Exceptions\\NonExistentImportBehavior' => 
    array (
      'phrase' => 
      array (
        '_vn_' => true,
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
    ),
    'Amasty\\Base\\Exceptions\\StopValidation' => 
    array (
      'validateResult' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Base\\Exceptions\\WrongBehaviorInterface' => 
    array (
      'phrase' => 
      array (
        '_vn_' => true,
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
    ),
    'Amasty\\Base\\Exceptions\\WrongValidatorInterface' => 
    array (
      'phrase' => 
      array (
        '_vn_' => true,
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
    ),
    'Amasty\\Base\\Helper\\CssChecker' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'asset' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Asset\\Repository\\Interceptor',
      ),
      'appEmulation' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\App\\Emulation',
      ),
      'file' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem\\Io\\File',
      ),
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem',
      ),
    ),
    'Amasty\\Base\\Helper\\Deploy' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem',
      ),
    ),
    'Amasty\\Base\\Helper\\Module' => 
    array (
      'extensionsProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\ExtensionsProvider',
      ),
      'linkValidator' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\LinkValidator',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
    ),
    'Amasty\\Base\\Model\\AdminNotification\\Messages' => 
    array (
      'session' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Session\\Interceptor',
      ),
    ),
    'Amasty\\Base\\Model\\AdminNotification\\Model\\ResourceModel\\Inbox\\Collection\\Exists' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Base\\Model\\AdminNotification\\Model\\ResourceModel\\Inbox\\Collection\\ExistsFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\Base\\Model\\AdminNotification\\Model\\ResourceModel\\Inbox\\Collection\\Exists',
      ),
    ),
    'Amasty\\Base\\Model\\AdminNotification\\Model\\ResourceModel\\Inbox\\Collection\\Expired' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Base\\Model\\AdminNotification\\Model\\ResourceModel\\Inbox\\Collection\\ExpiredFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\Base\\Model\\AdminNotification\\Model\\ResourceModel\\Inbox\\Collection\\Expired',
      ),
    ),
    'Amasty\\Base\\Model\\Config' => 
    array (
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'configWriter' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Storage\\Writer',
      ),
      'reinitableConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ReinitableConfig\\Interceptor',
      ),
    ),
    'Amasty\\Base\\Model\\Feed\\AdsProvider' => 
    array (
      'moduleList' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\FullModuleList',
      ),
      'adsFeed' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedTypes\\Ads',
      ),
    ),
    'Amasty\\Base\\Model\\Feed\\ExtensionsProvider' => 
    array (
      'extensionsFeed' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedTypes\\Extensions',
      ),
    ),
    'Amasty\\Base\\Model\\Feed\\FeedContentProvider' => 
    array (
      'curlFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\HTTP\\Adapter\\CurlFactory',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\Base\\Model\\Feed\\FeedTypes\\Ad\\Offline' => 
    array (
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem',
      ),
      'moduleReader' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Dir\\Reader',
      ),
    ),
    'Amasty\\Base\\Model\\Feed\\FeedTypes\\Ads' => 
    array (
      'cache' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Type\\Config',
      ),
      'serializer' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Serializer',
      ),
      'feedContentProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedContentProvider',
      ),
      'parser' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Parser',
      ),
      'adOffline' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedTypes\\Ad\\Offline',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
    ),
    'Amasty\\Base\\Model\\Feed\\FeedTypes\\Extensions' => 
    array (
      'serializer' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Serializer',
      ),
      'cache' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Proxy',
      ),
      'feedContentProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedContentProvider',
      ),
      'parser' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Parser',
      ),
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
      'linkValidator' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\LinkValidator',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
    ),
    'Amasty\\Base\\Model\\Feed\\FeedTypes\\News' => 
    array (
      'config' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Config',
      ),
      'feedContentProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedContentProvider',
      ),
      'parser' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Parser',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'moduleList' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\ModuleList',
      ),
      'inboxExistsFactory' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\AdminNotification\\Model\\ResourceModel\\Inbox\\Collection\\ExistsFactory',
      ),
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
      'dataObjectFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\DataObjectFactory',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
    ),
    'Amasty\\Base\\Model\\Feed\\NewsProcessor' => 
    array (
      'config' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Config',
      ),
      'inboxFactory' => 
      array (
        '_i_' => 'Magento\\AdminNotification\\Model\\InboxFactory',
      ),
      'expiredFactory' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\AdminNotification\\Model\\ResourceModel\\Inbox\\Collection\\ExpiredFactory',
      ),
      'newsFeed' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedTypes\\News',
      ),
    ),
    'Amasty\\Base\\Model\\GetCustomerIp' => 
    array (
      'remoteAddress' => 
      array (
        '_i_' => 'Magento\\Framework\\HTTP\\PhpEnvironment\\RemoteAddress',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
    ),
    'Amasty\\Base\\Model\\Import\\Behavior\\BehaviorProvider' => 
    array (
      'behaviors' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Base\\Model\\Import\\ImportCounter' => NULL,
    'Amasty\\Base\\Model\\Import\\Mapping\\Mapping' => NULL,
    'Amasty\\Base\\Model\\Import\\Validation\\EncodingValidator' => 
    array (
      'validationData' => 
      array (
        '_i_' => 'Magento\\Framework\\DataObject',
      ),
    ),
    'Amasty\\Base\\Model\\Import\\Validation\\Validator' => 
    array (
      'validationData' => 
      array (
        '_i_' => 'Magento\\Framework\\DataObject',
      ),
    ),
    'Amasty\\Base\\Model\\Import\\Validation\\ValidatorPool' => 
    array (
      'validators' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Base\\Model\\LessToCss\\Config' => 
    array (
      'reader' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\LessToCss\\Config\\Reader',
      ),
      'cache' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Type\\Config',
      ),
    ),
    'Amasty\\Base\\Model\\LessToCss\\Config\\Converter' => NULL,
    'Amasty\\Base\\Model\\LessToCss\\Config\\Reader' => 
    array (
      'fileResolver' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\FileResolver',
      ),
      'converter' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\LessToCss\\Config\\Converter',
      ),
      'schemaLocator' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\LessToCss\\Config\\SchemaLocator',
      ),
      'validationState' => 
      array (
        '_i_' => 'MiraklSeller\\Process\\Model\\ValidationState',
      ),
      'fileName' => 
      array (
        '_v_' => 'less_to_css.xml',
      ),
      'idAttributes' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'domDocumentClass' => 
      array (
        '_v_' => 'Magento\\Framework\\Config\\Dom',
      ),
      'defaultScope' => 
      array (
        '_v_' => 'global',
      ),
    ),
    'Amasty\\Base\\Model\\LessToCss\\Config\\SchemaLocator' => 
    array (
      'urnResolver' => 
      array (
        '_i_' => 'Magento\\Framework\\Config\\Dom\\UrnResolver',
      ),
    ),
    'Amasty\\Base\\Model\\LinkValidator' => NULL,
    'Amasty\\Base\\Model\\MagentoVersion' => 
    array (
      'cache' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Type\\Config',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
    ),
    'Amasty\\Base\\Model\\ModuleInfoProvider' => 
    array (
      'moduleReader' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Dir\\Reader',
      ),
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem\\Driver\\File',
      ),
      'serializer' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Serializer',
      ),
    ),
    'Amasty\\Base\\Model\\ModuleListProcessor' => 
    array (
      'moduleList' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\ModuleList',
      ),
      'extensionsProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\ExtensionsProvider',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
    ),
    'Amasty\\Base\\Model\\Parser' => 
    array (
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
    ),
    'Amasty\\Base\\Model\\Response\\DownloadOutput' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'downloadableFile' => 
      array (
        '_i_' => 'Magento\\Downloadable\\Helper\\File',
      ),
      'coreFileStorageDb' => 
      array (
        '_i_' => 'Magento\\MediaStorage\\Helper\\File\\Storage\\Database\\Proxy',
      ),
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem',
      ),
      'session' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Session\\Interceptor',
      ),
      'fileReadFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem\\File\\ReadFactory',
      ),
    ),
    'Amasty\\Base\\Model\\Response\\File\\FileOctetResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\Base\\Model\\Response\\File\\FileOctetResponse',
      ),
    ),
    'Amasty\\Base\\Model\\Response\\File\\FileUrlOctetResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\Base\\Model\\Response\\File\\FileUrlOctetResponse',
      ),
    ),
    'Amasty\\Base\\Model\\Response\\OctetResponseInterfaceFactory' => 
    array (
      'ioFile' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem\\Io\\File',
      ),
      'responseFactoryAssociationMap' => 
      array (
        '_vac_' => 
        array (
          'file' => 
          array (
            '_i_' => 'Amasty\\Base\\Model\\Response\\File\\FileOctetResponseFactory',
          ),
          'url' => 
          array (
            '_i_' => 'Amasty\\Base\\Model\\Response\\File\\FileUrlOctetResponseFactory',
          ),
        ),
      ),
    ),
    'Amasty\\Base\\Model\\Serializer' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'unserialize' => 
      array (
        '_i_' => 'Magento\\Framework\\Unserialize\\Unserialize',
      ),
    ),
    'Amasty\\Base\\Model\\Source\\Frequency' => NULL,
    'Amasty\\Base\\Model\\Source\\NotificationType' => NULL,
    'Amasty\\Base\\Observer\\AddBodyClassName' => 
    array (
      'pageConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Page\\Config\\Interceptor',
      ),
      'design' => 
      array (
        '_i_' => 'Magento\\Theme\\Model\\View\\Design\\Proxy',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
    ),
    'Amasty\\Base\\Observer\\GenerateInformationTab' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'assetRepo' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Asset\\Repository\\Interceptor',
      ),
      'configStructure' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Structure\\Interceptor',
      ),
      'extensionsProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\ExtensionsProvider',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
    ),
    'Amasty\\Base\\Observer\\PreDispatchAdminActionController' => 
    array (
      'newsProcessor' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\NewsProcessor',
      ),
      'backendAuthSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
    ),
    'Amasty\\Base\\Observer\\SaveConfig' => 
    array (
      'cache' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Type\\Config',
      ),
    ),
    'Amasty\\Base\\Plugin\\AdminNotification\\Block\\Grid\\Renderer\\Actions' => 
    array (
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
    ),
    'Amasty\\Base\\Plugin\\AdminNotification\\Block\\Grid\\Renderer\\Notice' => NULL,
    'Amasty\\Base\\Plugin\\AdminNotification\\Block\\ToolbarEntry' => NULL,
    'Amasty\\Base\\Plugin\\Adminhtml\\Block\\Widget\\Form\\Element\\Dependence' => 
    array (
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
    ),
    'Amasty\\Base\\Plugin\\Backend\\Block\\Menu' => NULL,
    'Amasty\\Base\\Plugin\\Backend\\Model\\Config\\StructurePlugin' => 
    array (
      'adsProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\AdsProvider',
      ),
      'config' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Config',
      ),
      'scopeDefiner' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\ScopeDefiner',
      ),
      'linkValidator' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\LinkValidator',
      ),
    ),
    'Amasty\\Base\\Plugin\\Backend\\Model\\Menu\\Builder' => 
    array (
      'menuConfig' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Menu\\Config',
      ),
      'iteratorFactory' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Menu\\Filter\\IteratorFactory',
      ),
      'itemFactory' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Menu\\ItemFactory',
      ),
      'moduleList' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\ModuleList',
      ),
      'configStructure' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Structure\\Interceptor',
      ),
      'metadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'objectFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\DataObjectFactory',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'extensionsProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\ExtensionsProvider',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
    ),
    'Amasty\\Base\\Plugin\\Backend\\Model\\Menu\\Item' => 
    array (
      'extensionsProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\ExtensionsProvider',
      ),
      'moduleInfoProvider' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\ModuleInfoProvider',
      ),
    ),
    'Amasty\\Base\\Plugin\\Config\\Block\\System\\Config\\Form\\Field' => 
    array (
      'assetRepo' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Asset\\Repository\\Interceptor',
      ),
    ),
    'Amasty\\Base\\Plugin\\Framework\\View\\TemplateEngine\\Php' => 
    array (
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
    ),
    'Amasty\\Base\\Plugin\\Frontend\\AddAssets' => 
    array (
      'config' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Page\\Config\\Interceptor',
      ),
      'cache' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Proxy',
      ),
      'lessConfig' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\LessToCss\\Config',
      ),
      'layout' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Layout\\Interceptor',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'fallback' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Design\\FileResolution\\Fallback\\StaticFile',
      ),
      'design' => 
      array (
        '_i_' => 'Magento\\Theme\\Model\\View\\Design\\Proxy',
      ),
    ),
    'Amasty\\Base\\Setup\\Recurring' => NULL,
    'Amasty\\Base\\Setup\\SerializedFieldDataConverter' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'connectionResource' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ResourceConnection\\Interceptor',
      ),
    ),
    'Amasty\\Base\\Setup\\UpgradeData' => 
    array (
      'appState' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\State\\Interceptor',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'extensionsFeed' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Feed\\FeedTypes\\Extensions',
      ),
    ),
    'Amasty\\Base\\Ui\\Component\\Listing\\Column\\StoreOptions' => 
    array (
      'systemStore' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\System\\Store',
      ),
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
    ),
    'Amasty\\Base\\Ui\\Component\\Listing\\Column\\ViewAction' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\Context',
      ),
      'uiComponentFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponentFactory',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'components' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CronScheduleList\\Block\\Adminhtml\\Advertising' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'moduleHelper' => 
      array (
        '_i_' => 'Amasty\\Base\\Helper\\Module',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CronScheduleList\\Block\\Adminhtml\\Notice' => 
    array (
      'jobsCollection' => 
      array (
        '_i_' => 'Amasty\\CronScheduleList\\Model\\ScheduleCollectionFactory',
      ),
      'dateTimeBuilder' => 
      array (
        '_i_' => 'Amasty\\CronScheduleList\\Model\\DateTimeBuilder',
      ),
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CronScheduleList\\Cron\\Activity' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
    ),
    'Amasty\\CronScheduleList\\Model\\DateTimeBuilder' => 
    array (
      'dateTime' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime\\DateTime',
      ),
      'dateTimeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime',
      ),
    ),
    'Amasty\\CronScheduleList\\Model\\OptionSource\\Status' => NULL,
    'Amasty\\CronScheduleList\\Model\\OptionSource\\StatusFilter' => NULL,
    'Amasty\\CronScheduleList\\Model\\ScheduleCollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\CronScheduleList\\Model\\ScheduleCollection',
      ),
    ),
    'Amasty\\CronScheduleList\\Plugin\\ScheduleCollectionPlugin' => NULL,
    'Amasty\\CronScheduleList\\Ui\\DataProvider\\Listing\\ScheduleDataProvider' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Amasty\\CronScheduleList\\Model\\ScheduleCollectionFactory',
      ),
      'name' => 
      array (
        '_vn_' => true,
      ),
      'primaryFieldName' => 
      array (
        '_vn_' => true,
      ),
      'requestFieldName' => 
      array (
        '_vn_' => true,
      ),
      'meta' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Block\\Adminhtml\\Link' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Widget\\Context',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Block\\Adminhtml\\Link\\Edit' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Widget\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Block\\Adminhtml\\Link\\Edit\\Form' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'systemStore' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\System\\Store',
      ),
      'yesNo' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\Yesno',
      ),
      'referenceType' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\Source\\ReferenceType',
      ),
      'targetType' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\Source\\TargetType',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Block\\Adminhtml\\Link\\Edit\\Form\\Renderer\\ProductPicker' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'backendHelper' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'productCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\CollectionFactory',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Block\\Adminhtml\\Link\\Edit\\Form\\Renderer\\ReferenceResource' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'elementFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Form\\Element\\Factory',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Block\\Adminhtml\\System\\Config\\Information' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Helper\\Data' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
    ),
    'Amasty\\CrossLinks\\Model\\Link' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Helper\\Data',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'categoryRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\CategoryRepository\\Interceptor',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Model\\LinkFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
    ),
    'Amasty\\CrossLinks\\Model\\LinkRepository' => 
    array (
      'resource' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\ResourceModel\\Link',
      ),
      'factory' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\LinkFactory',
      ),
    ),
    'Amasty\\CrossLinks\\Model\\ReplaceManager' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Helper\\Data',
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\ResourceModel\\Link\\CollectionFactory',
      ),
    ),
    'Amasty\\CrossLinks\\Model\\ResourceModel\\Link' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\CrossLinks\\Model\\ResourceModel\\Link\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\CrossLinks\\Model\\ResourceModel\\Link\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
    ),
    'Amasty\\CrossLinks\\Model\\Source\\Blog' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
    ),
    'Amasty\\CrossLinks\\Model\\Source\\CategoryReplacementAttributes' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\Attribute\\CollectionFactory',
      ),
      'allowedAttributeCodes' => 
      array (
        '_v_' => 
        array (
          'description' => 'description',
          'short_description' => 'short_description',
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Model\\Source\\Faq' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
    ),
    'Amasty\\CrossLinks\\Model\\Source\\ProductReplacementAttributes' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Attribute\\CollectionFactory',
      ),
      'allowedAttributeCodes' => 
      array (
        '_v_' => 
        array (
          'description' => 'description',
          'short_description' => 'short_description',
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Model\\Source\\ReferenceType' => NULL,
    'Amasty\\CrossLinks\\Model\\Source\\TargetType' => NULL,
    'Amasty\\CrossLinks\\Observer\\AddHandler' => 
    array (
      'outputHelper' => 
      array (
        '_i_' => 'Magento\\Catalog\\Helper\\Output\\Interceptor',
      ),
      'replaceManager' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\ReplaceManager',
      ),
    ),
    'Amasty\\CrossLinks\\Plugin\\Blog\\Model\\PostsPlugin' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Helper\\Data',
      ),
      'replaceManager' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\ReplaceManager',
      ),
    ),
    'Amasty\\CrossLinks\\Plugin\\Cms\\Block\\Page' => 
    array (
      'replaceManager' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\ReplaceManager',
      ),
    ),
    'Amasty\\CrossLinks\\Plugin\\Faq' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Helper\\Data',
      ),
      'replaceManager' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\ReplaceManager',
      ),
    ),
    'Amasty\\CrossLinks\\Setup\\InstallSchema' => NULL,
    'Amasty\\CrossLinks\\Ui\\Component\\Listing\\Column\\Actions' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\Context',
      ),
      'uiComponentFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponentFactory',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'components' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\CrossLinks\\Ui\\Component\\Listing\\Column\\Stores' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\Context',
      ),
      'uiComponentFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponentFactory',
      ),
      'systemStore' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\System\\Store',
      ),
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
      'components' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'storeKey' => 
      array (
        '_v_' => 'store_ids',
      ),
    ),
    'Amasty\\CrossLinks\\Ui\\DataProvider\\Link\\DataProvider' => 
    array (
      'name' => 
      array (
        '_vn_' => true,
      ),
      'primaryFieldName' => 
      array (
        '_vn_' => true,
      ),
      'requestFieldName' => 
      array (
        '_vn_' => true,
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Amasty\\CrossLinks\\Model\\ResourceModel\\Link\\CollectionFactory',
      ),
      'meta' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Mage24Fix\\Plugin\\Catalog\\ViewModel\\Product\\BreadcrumbsPlugin' => 
    array (
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
    ),
    'Amasty\\Meta\\Api\\Data\\ConfigInterfaceFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\Meta\\Api\\Data\\ConfigInterface',
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Config' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Widget\\Context',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Config\\Grid' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'backendHelper' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'category' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\Interceptor',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\Config',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Custom\\Edit' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Widget\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Custom\\Edit\\Form' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Custom\\Edit\\Tab\\Content' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'dataHelper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'store' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\System\\Store',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Custom\\Edit\\Tab\\General' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'store' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\System\\Store',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Custom\\Edit\\Tabs' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'jsonEncoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Json\\Encoder',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Custom\\Grid' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'backendHelper' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\Config',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Edit\\DeleteButton' => 
    array (
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Edit\\SaveAndContinueButton' => NULL,
    'Amasty\\Meta\\Block\\Adminhtml\\System\\Config\\Information' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Widget\\Form\\Tab\\Abstracts\\Category' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'dataHelper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'store' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\System\\Store',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Widget\\Form\\Tab\\Abstracts\\Product' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'dataHelper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'store' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\System\\Store',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Widget\\Grid\\Column\\Filter\\Store' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'resourceHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\DB\\Helper',
      ),
      'systemStore' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\System\\Store',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Widget\\Grid\\Column\\Renderer\\Category' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Block\\Adminhtml\\Widget\\Grid\\Column\\Renderer\\Store' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'systemStore' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\System\\Store',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Helper\\Data' => 
    array (
      'storeManagerInterface' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'http' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'category' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Category\\Interceptor',
      ),
      'catalogHelper' => 
      array (
        '_i_' => 'Magento\\Catalog\\Helper\\Data\\Proxy',
      ),
      'priceCurrency' => 
      array (
        '_i_' => 'Magento\\Directory\\Model\\PriceCurrency\\Interceptor',
      ),
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'metaConfig' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\Config',
      ),
      'categoryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      '_escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
      'integrationFactory' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\Integration\\IntegrationFactory',
      ),
    ),
    'Amasty\\Meta\\Helper\\UrlKeyHandler' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'helperData' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
      'rewriteCollectionFactory' => 
      array (
        '_i_' => 'Magento\\UrlRewrite\\Model\\ResourceModel\\UrlRewriteCollectionFactory',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'configProvider' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ConfigProvider',
      ),
      'urlRewriteFactory' => 
      array (
        '_i_' => 'Magento\\UrlRewrite\\Model\\UrlRewriteFactory',
      ),
      'eavResource' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ResourceModel\\EavResource',
      ),
      'productResource' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'urlRewrite' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ResourceModel\\UrlRewrite',
      ),
    ),
    'Amasty\\Meta\\Model\\Config' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Model\\ConfigFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\Meta\\Model\\Config',
      ),
    ),
    'Amasty\\Meta\\Model\\ConfigProvider' => 
    array (
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\Meta\\Model\\Integration\\IntegrationFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
    ),
    'Amasty\\Meta\\Model\\Registry' => NULL,
    'Amasty\\Meta\\Model\\Repository\\ConfigRepository' => 
    array (
      'searchResultsFactory' => 
      array (
        '_i_' => 'Magento\\Ui\\Api\\Data\\BookmarkSearchResultsInterfaceFactory',
      ),
      'configFactory' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ConfigFactory',
      ),
      'configResource' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ResourceModel\\Config',
      ),
      'configCollectionFactory' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ResourceModel\\Config\\CollectionFactory',
      ),
    ),
    'Amasty\\Meta\\Model\\ResourceModel\\Config' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Meta\\Model\\ResourceModel\\Config\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Meta\\Model\\ResourceModel\\Config\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\Meta\\Model\\ResourceModel\\Config\\Collection',
      ),
    ),
    'Amasty\\Meta\\Model\\ResourceModel\\EavResource' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Meta\\Model\\ResourceModel\\UrlRewrite' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\Meta\\Model\\Source\\CategoryData' => NULL,
    'Amasty\\Meta\\Model\\Source\\CategoryTree' => 
    array (
      'dataHelper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Model\\System\\Store' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\Meta\\Model\\UrlKey\\Generate\\Processor' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\CollectionFactory',
      ),
      'configProvider' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ConfigProvider',
      ),
      'urlGenerator' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\UrlKeyHandler',
      ),
    ),
    'Amasty\\Meta\\Model\\UrlKey\\Generate\\ProcessorFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\Meta\\Model\\UrlKey\\Generate\\Processor',
      ),
    ),
    'Amasty\\Meta\\Observer\\Catalog\\Category\\InitAfter' => 
    array (
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'configInterface' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'filterableAttributeList' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Layer\\Category\\FilterableAttributeList',
      ),
      'requestInterface' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'storeManagerInterface' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'catalogHelper' => 
      array (
        '_i_' => 'Magento\\Catalog\\Helper\\Data\\Interceptor',
      ),
      'metaHelper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
      'metaRegistry' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\Registry',
      ),
    ),
    'Amasty\\Meta\\Observer\\Catalog\\Product\\AfterSave' => 
    array (
      'helperUrl' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\UrlKeyHandler',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\Meta\\Observer\\Catalog\\Product\\BeforeSave' => NULL,
    'Amasty\\Meta\\Observer\\Catalog\\Product\\Collection\\LoadAfter' => 
    array (
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'configInterface' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'filterableAttributeList' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Layer\\Category\\FilterableAttributeList',
      ),
      'requestInterface' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'storeManagerInterface' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'catalogHelper' => 
      array (
        '_i_' => 'Magento\\Catalog\\Helper\\Data\\Interceptor',
      ),
      'layoutInterface' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Layout\\Interceptor',
      ),
      'metaHelper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Observer\\Catalog\\Product\\View' => 
    array (
      'helperUrl' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\UrlKeyHandler',
      ),
      'data' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\Meta\\Plugin\\Catalog\\Block\\Category\\View' => 
    array (
      'data' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Plugin\\Catalog\\Helper\\Output' => 
    array (
      'data' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Plugin\\Cms\\Model\\Page' => 
    array (
      'dataHelper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Plugin\\SeoRichData\\Block\\Product' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Plugin\\ShopbyBrand\\Controller\\RouterPlugin' => 
    array (
      'registry' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\Registry',
      ),
    ),
    'Amasty\\Meta\\Plugin\\Theme\\Block\\Html\\Title' => 
    array (
      'data' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Plugin\\View\\Asset\\Repository' => 
    array (
      'data' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Plugin\\View\\Page\\Config' => 
    array (
      'dataHelper' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
    ),
    'Amasty\\Meta\\Plugin\\View\\Page\\Title' => 
    array (
      'data' => 
      array (
        '_i_' => 'Amasty\\Meta\\Helper\\Data',
      ),
      'configInterface' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
    ),
    'Amasty\\Meta\\Setup\\InstallSchema' => NULL,
    'Amasty\\Meta\\Setup\\UpgradeSchema' => 
    array (
      'addBrandOptions' => 
      array (
        '_i_' => 'Amasty\\Meta\\Setup\\UpgradeSchema\\AddBrandOptions',
      ),
    ),
    'Amasty\\Meta\\Setup\\UpgradeSchema\\AddBrandOptions' => NULL,
    'Amasty\\Meta\\Ui\\Component\\Config\\Form\\BrandFieldset' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\Context',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'components' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\Meta\\Ui\\DataProvider\\Config\\Form\\DataProvider' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\ResourceModel\\Config\\CollectionFactory',
      ),
      'configRepository' => 
      array (
        '_i_' => 'Amasty\\Meta\\Model\\Repository\\ConfigRepository',
      ),
      'dataPersistor' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\DataPersistor',
      ),
      'name' => 
      array (
        '_vn_' => true,
      ),
      'primaryFieldName' => 
      array (
        '_vn_' => true,
      ),
      'requestFieldName' => 
      array (
        '_vn_' => true,
      ),
      'meta' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Block\\Adminhtml\\System\\Config\\Information' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Block\\Sitemap' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoHtmlSitemap\\Helper\\Data',
      ),
      'helperRenderer' => 
      array (
        '_i_' => 'Amasty\\SeoHtmlSitemap\\Helper\\Renderer',
      ),
      'sitemapFactory' => 
      array (
        '_i_' => 'Amasty\\SeoHtmlSitemap\\Model\\SitemapFactory',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Controller\\Router' => 
    array (
      'actionFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ActionFactory',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'url' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'pageFactory' => 
      array (
        '_i_' => 'Magento\\Cms\\Model\\PageFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'response' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Response\\Http\\Interceptor',
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Helper\\Data' => 
    array (
      'serializer' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Serializer',
      ),
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Helper\\LandingPage' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'landingPageFactory' => 
      array (
        '_i_' => 'Amasty\\SeoHtmlSitemap\\Model\\Page\\Xlanding\\PageFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Helper\\Renderer' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Model\\Config\\Source\\GridType' => NULL,
    'Amasty\\SeoHtmlSitemap\\Model\\Config\\Source\\NumberRange' => NULL,
    'Amasty\\SeoHtmlSitemap\\Model\\Page\\Xlanding\\PageFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Model\\ResourceModel\\Page\\Xlanding\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Model\\Sitemap' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'stockHelper' => 
      array (
        '_i_' => 'Magento\\CatalogInventory\\Helper\\Stock',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoHtmlSitemap\\Helper\\Data',
      ),
      'cmsPageHelper' => 
      array (
        '_i_' => 'Magento\\Cms\\Helper\\Page',
      ),
      'landingPageHelper' => 
      array (
        '_i_' => 'Amasty\\SeoHtmlSitemap\\Helper\\LandingPage',
      ),
      'categoryRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\CategoryRepository\\Interceptor',
      ),
      'pageCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Cms\\Model\\ResourceModel\\Page\\CollectionFactory',
      ),
      'productCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\CollectionFactory',
      ),
      'categoryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'landingPageCollectionFactory' => 
      array (
        '_i_' => 'Amasty\\SeoHtmlSitemap\\Model\\ResourceModel\\Page\\Xlanding\\CollectionFactory',
      ),
      'categoryTree' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\Tree',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoHtmlSitemap\\Model\\SitemapFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\SeoHtmlSitemap\\Model\\Sitemap',
      ),
    ),
    'Amasty\\SeoRichData\\Block\\Adminhtml\\System\\Config\\Information' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoRichData\\Block\\JsonLd' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Context',
      ),
      'dataCollector' => 
      array (
        '_i_' => 'Amasty\\SeoRichData\\Model\\DataCollector',
      ),
      'coreRegistry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'categoryHelper' => 
      array (
        '_i_' => 'Amasty\\SeoRichData\\Helper\\Category',
      ),
      'jsonEncoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Json\\Encoder',
      ),
      'pageConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Page\\Config\\Interceptor',
      ),
      'configHelper' => 
      array (
        '_i_' => 'Amasty\\SeoRichData\\Helper\\Config',
      ),
      'layerResolver' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Layer\\Resolver\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoRichData\\Helper\\Category' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\SeoRichData\\Helper\\Config' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'countryFactory' => 
      array (
        '_i_' => 'Magento\\Directory\\Model\\CountryFactory',
      ),
    ),
    'Amasty\\SeoRichData\\Model\\DataCollector' => 
    array (
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoRichData\\Model\\Source\\Attributes' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Attribute\\CollectionFactory',
      ),
    ),
    'Amasty\\SeoRichData\\Model\\Source\\Breadcrumbs' => NULL,
    'Amasty\\SeoRichData\\Model\\Source\\Category\\Description' => NULL,
    'Amasty\\SeoRichData\\Model\\Source\\Product\\Description' => NULL,
    'Amasty\\SeoRichData\\Model\\Source\\Product\\Offer' => NULL,
    'Amasty\\SeoRichData\\Observer\\ProductInitAfterObserver' => 
    array (
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'categoryRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\CategoryRepository\\Interceptor',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
    ),
    'Amasty\\SeoRichData\\Plugin\\Block\\Breadcrumbs' => 
    array (
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'view' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\View',
      ),
      'dataCollector' => 
      array (
        '_i_' => 'Amasty\\SeoRichData\\Model\\DataCollector',
      ),
      'configHelper' => 
      array (
        '_i_' => 'Amasty\\SeoRichData\\Helper\\Config',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
    ),
    'Amasty\\SeoRichData\\Plugin\\Microdata\\Replacer' => NULL,
    'Amasty\\SeoSingleUrl\\Block\\Adminhtml\\System\\Config\\Information' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoSingleUrl\\Helper\\Data' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'jsonEncoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Json\\Encoder',
      ),
      'categoryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'urlFinder' => 
      array (
        '_i_' => 'Amasty\\SeoSingleUrl\\Model\\UrlRewrite\\Storage\\Interceptor',
      ),
    ),
    'Amasty\\SeoSingleUrl\\Model\\Source\\Breadcrumb' => NULL,
    'Amasty\\SeoSingleUrl\\Model\\Source\\By' => NULL,
    'Amasty\\SeoSingleUrl\\Model\\Source\\Type' => NULL,
    'Amasty\\SeoSingleUrl\\Observer\\System\\ConfigChanged' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoSingleUrl\\Helper\\Data',
      ),
      'reinitableConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ReinitableConfig\\Interceptor',
      ),
      'configWriter' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Storage\\Writer',
      ),
    ),
    'Amasty\\SeoSingleUrl\\Plugin\\Catalog\\Controller\\Product\\View' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoSingleUrl\\Helper\\Data',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'catalogSession' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Session\\Interceptor',
      ),
    ),
    'Amasty\\SeoSingleUrl\\Plugin\\Catalog\\Helper\\Data' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoSingleUrl\\Helper\\Data',
      ),
      'categoryFactoryCollection' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'catalogData' => 
      array (
        '_i_' => 'Magento\\Catalog\\Helper\\Data\\Interceptor',
      ),
      'serializer' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Serializer',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\SeoSingleUrl\\Plugin\\Catalog\\Model\\Product' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoSingleUrl\\Helper\\Data',
      ),
    ),
    'Amasty\\SeoSingleUrl\\Plugin\\Catalog\\Model\\Product\\Url' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoSingleUrl\\Helper\\Data',
      ),
    ),
    'Amasty\\SeoSingleUrl\\Plugin\\Sitemap\\Model\\ResourceModel\\Catalog\\Product' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoSingleUrl\\Helper\\Data',
      ),
    ),
    'Amasty\\SeoSingleUrl\\Plugin\\XmlSitemap\\Model\\Sitemap' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoSingleUrl\\Helper\\Data',
      ),
    ),
    'Amasty\\SeoToolKit\\Api\\Data\\RedirectInterfaceFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\SeoToolKit\\Api\\Data\\RedirectInterface',
      ),
    ),
    'Amasty\\SeoToolKit\\Block\\Adminhtml\\Edit\\DeleteButton' => 
    array (
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
    ),
    'Amasty\\SeoToolKit\\Block\\Adminhtml\\Edit\\SaveAndContinueButton' => NULL,
    'Amasty\\SeoToolKit\\Block\\Adminhtml\\System\\Config\\Information' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoToolKit\\Block\\Toolbar' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoToolKit\\Controller\\RedirectRouterAbstract' => 
    array (
      'actionFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ActionFactory',
      ),
      'response' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Response\\Http\\Interceptor',
      ),
      'redirectGetter' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\Redirect\\RedirectGetter',
      ),
      'targetPathResolver' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\Redirect\\TargetPathResolver',
      ),
    ),
    'Amasty\\SeoToolKit\\Controller\\Router' => 
    array (
      'actionFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ActionFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
    ),
    'Amasty\\SeoToolKit\\Controller\\RouterPostRedirect' => 
    array (
      'actionFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ActionFactory',
      ),
      'response' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Response\\Http\\Interceptor',
      ),
      'redirectGetter' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\Redirect\\RedirectGetter',
      ),
      'targetPathResolver' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\Redirect\\TargetPathResolver',
      ),
    ),
    'Amasty\\SeoToolKit\\Controller\\RouterPreRedirect' => 
    array (
      'actionFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ActionFactory',
      ),
      'response' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Response\\Http\\Interceptor',
      ),
      'redirectGetter' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\Redirect\\RedirectGetter',
      ),
      'targetPathResolver' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\Redirect\\TargetPathResolver',
      ),
    ),
    'Amasty\\SeoToolKit\\Helper\\Config' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\Redirect' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\RedirectFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\SeoToolKit\\Model\\Redirect',
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\Redirect\\RedirectGetter' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect\\CollectionFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\Redirect\\TargetPathResolver' => NULL,
    'Amasty\\SeoToolKit\\Model\\RegistryConstants' => NULL,
    'Amasty\\SeoToolKit\\Model\\Repository\\RedirectRepository' => 
    array (
      'searchResultsFactory' => 
      array (
        '_i_' => 'Magento\\Ui\\Api\\Data\\BookmarkSearchResultsInterfaceFactory',
      ),
      'redirectFactory' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\RedirectFactory',
      ),
      'redirectResource' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect',
      ),
      'redirectCollectionFactory' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect\\CollectionFactory',
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect\\Collection',
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect\\Grid\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'mainTable' => 
      array (
        '_v_' => 'amasty_seotoolkit_redirect',
      ),
      'resourceModel' => 
      array (
        '_v_' => 'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect',
      ),
      'identifierName' => 
      array (
        '_vn_' => true,
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\Source\\Eav\\Robots' => 
    array (
      'options' => 
      array (
        '_v_' => 
        array (
          'option1' => 
          array (
            'value' => 'default',
            'label' => 'Default',
          ),
          'option2' => 
          array (
            'value' => 'index,follow',
            'label' => 'index,follow',
          ),
          'option3' => 
          array (
            'value' => 'index,nofollow',
            'label' => 'index,nofollow',
          ),
          'option4' => 
          array (
            'value' => 'noindex,follow',
            'label' => 'noindex,follow',
          ),
          'option5' => 
          array (
            'value' => 'noindex,nofollow',
            'label' => 'noindex,nofollow',
          ),
        ),
      ),
    ),
    'Amasty\\SeoToolKit\\Model\\Source\\PrevNextYesNo' => NULL,
    'Amasty\\SeoToolKit\\Model\\Source\\RedirectType' => NULL,
    'Amasty\\SeoToolKit\\Observer\\Redirect' => 
    array (
      'appState' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\State\\Interceptor',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'config' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
      'response' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Response\\Http\\Interceptor',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\CatalogSearch\\Controller\\Result\\Index' => 
    array (
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
      'searchHelper' => 
      array (
        '_i_' => 'Magento\\Search\\Helper\\Data\\Interceptor',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Catalog\\Block\\Category\\ViewPlugin' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'config' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Catalog\\Helper\\Product\\ViewPlugin' => 
    array (
      'coreRegistry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Catalog\\Ui\\DataProvider\\Product\\Form\\Modifier\\EavPlugin' => 
    array (
      'locator' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Locator\\RegistryLocator',
      ),
      'attributeRepository' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\AttributeRepository',
      ),
      'searchCriteriaBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilder',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Framework\\App\\Response\\Http' => 
    array (
      'config' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
      'customerIp' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\GetCustomerIp',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'layoutFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\LayoutFactory',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Framework\\App\\Router\\NoRouteHandler' => 
    array (
      'config' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Framework\\Controller\\ProcessPageResultPlugin' => 
    array (
      'config' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'layout' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Layout\\Interceptor',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Framework\\View\\Page\\Config' => 
    array (
      'config' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Framework\\View\\Page\\Title' => 
    array (
      'config' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Model\\Menu\\Builder' => NULL,
    'Amasty\\SeoToolKit\\Plugin\\Pager' => 
    array (
      'urlHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\Url\\Helper\\Data',
      ),
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\Search\\Helper\\Data' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Helper\\Config',
      ),
    ),
    'Amasty\\SeoToolKit\\Plugin\\View\\Page\\Config\\Renderer' => 
    array (
      'config' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Page\\Config\\Interceptor',
      ),
      'cache' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Proxy',
      ),
    ),
    'Amasty\\SeoToolKit\\Setup\\Uninstall' => 
    array (
      'deleteEavAttributes' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Setup\\Uninstall\\DeleteEavAttributes',
      ),
    ),
    'Amasty\\SeoToolKit\\Setup\\Uninstall\\DeleteEavAttributes' => 
    array (
      'moduleDataSetup' => 
      array (
        '_i_' => 'Magento\\Setup\\Module\\DataSetup',
      ),
      'eavSetupFactory' => 
      array (
        '_i_' => 'Magento\\Eav\\Setup\\EavSetupFactory',
      ),
    ),
    'Amasty\\SeoToolKit\\Setup\\UpgradeData' => 
    array (
      'resourceConfig' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\ResourceModel\\Config',
      ),
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem',
      ),
      'addCanonical' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Setup\\UpgradeData\\AddCanonical',
      ),
    ),
    'Amasty\\SeoToolKit\\Setup\\UpgradeData\\AddCanonical' => 
    array (
      'moduleDataSetup' => 
      array (
        '_i_' => 'Magento\\Setup\\Module\\DataSetup',
      ),
      'eavSetupFactory' => 
      array (
        '_i_' => 'Magento\\Eav\\Setup\\EavSetupFactory',
      ),
    ),
    'Amasty\\SeoToolKit\\Setup\\UpgradeSchema' => 
    array (
      'createRedirect' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Setup\\UpgradeSchema\\CreateRedirect',
      ),
    ),
    'Amasty\\SeoToolKit\\Setup\\UpgradeSchema\\CreateRedirect' => NULL,
    'Amasty\\SeoToolKit\\Ui\\Component\\Redirect\\Listing\\Column\\Actions' => 
    array (
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\Context',
      ),
      'uiComponentFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponentFactory',
      ),
      'components' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoToolKit\\Ui\\DataProvider\\Redirect\\Form\\DataProvider' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\ResourceModel\\Redirect\\CollectionFactory',
      ),
      'redirectRepository' => 
      array (
        '_i_' => 'Amasty\\SeoToolKit\\Model\\Repository\\RedirectRepository',
      ),
      'dataPersistor' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\DataPersistor',
      ),
      'name' => 
      array (
        '_vn_' => true,
      ),
      'primaryFieldName' => 
      array (
        '_vn_' => true,
      ),
      'requestFieldName' => 
      array (
        '_vn_' => true,
      ),
      'meta' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\SeoToolKit\\Ui\\DataProvider\\Redirect\\Listing\\DataProvider' => 
    array (
      'name' => 
      array (
        '_vn_' => true,
      ),
      'primaryFieldName' => 
      array (
        '_vn_' => true,
      ),
      'requestFieldName' => 
      array (
        '_vn_' => true,
      ),
      'reporting' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\Reporting',
      ),
      'searchCriteriaBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\Search\\SearchCriteriaBuilder',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'filterBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\FilterBuilder',
      ),
      'meta' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\Action\\Full' => 
    array (
      'metadataPool' => 
      array (
        '_i_' => 'Magento\\Framework\\EntityManager\\MetadataPool',
      ),
      'batchProvider' => 
      array (
        '_i_' => 'Magento\\Framework\\Indexer\\BatchProvider',
      ),
      'activeTableSwitcher' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Indexer\\ActiveTableSwitcher',
      ),
      'batchQueryGenerator' => 
      array (
        '_i_' => 'Magento\\Framework\\DB\\Query\\Generator',
      ),
      'indexAdapter' => 
      array (
        '_i_' => 'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\IndexAdapter',
      ),
    ),
    'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\Action\\Row' => 
    array (
      'indexAdapter' => 
      array (
        '_i_' => 'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\IndexAdapter',
      ),
    ),
    'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\Action\\Rows' => 
    array (
      'indexAdapter' => 
      array (
        '_i_' => 'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\IndexAdapter',
      ),
    ),
    'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\IndexAdapter' => 
    array (
      'adapterFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerchCore\\Model\\ResourceModel\\Product\\Indexer\\Eav\\AdapterFactory',
      ),
    ),
    'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\Processor' => 
    array (
      'indexerRegistry' => 
      array (
        '_i_' => 'Magento\\Framework\\Indexer\\IndexerRegistry',
      ),
    ),
    'Amasty\\VisualMerchCore\\Model\\ResourceModel\\Product\\Indexer\\Eav\\Adapter' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'tableStrategy' => 
      array (
        '_ins_' => 'Magento\\Framework\\Indexer\\Table\\Strategy',
      ),
      'eavConfig' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\VisualMerchCore\\Model\\ResourceModel\\Product\\Indexer\\Eav\\AdapterFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\VisualMerchCore\\Model\\ResourceModel\\Product\\Indexer\\Eav\\Adapter',
      ),
    ),
    'Amasty\\VisualMerchCore\\Plugin\\Catalog\\Model\\ProductPlugin' => 
    array (
      'processor' => 
      array (
        '_i_' => 'Amasty\\VisualMerchCore\\Model\\Indexer\\Catalog\\Product\\Eav\\Processor',
      ),
    ),
    'Amasty\\VisualMerchCore\\Setup\\InstallSchema' => NULL,
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Category\\Edit' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Conditions' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'ruleFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\RuleFactory',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Conditions\\Form' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'rendererFieldset' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Widget\\Form\\Renderer\\Fieldset',
      ),
      'conditions' => 
      array (
        '_i_' => 'Magento\\Rule\\Block\\Conditions',
      ),
      'adminhtmlDataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Conditions\\Import' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Products' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Products\\AssignProducts' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'jsonEncoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Json\\Encoder',
      ),
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Products\\AssignProducts\\Grid' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'backendHelper' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'coreRegistry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'status' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Product\\Attribute\\Source\\Status',
      ),
      'visibility' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Product\\Visibility',
      ),
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Products\\Listing' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'backendHelper' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'catalogImage' => 
      array (
        '_i_' => 'Magento\\Catalog\\Helper\\Image',
      ),
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'objectFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\DataObjectFactory',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'emulation' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\App\\Emulation',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\System\\Config\\Information' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'moduleList' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\ModuleList',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Widget\\Input\\Search' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Widget\\Select\\Categories' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'categories' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Source\\Category',
      ),
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'categoryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Block\\Adminhtml\\Widget\\Select\\SortOrder' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'sorting' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\Sorting',
      ),
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Cron\\CatalogCategoryProductReindex' => 
    array (
      'indexer' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Interceptor',
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'backendConfig' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Interceptor',
      ),
      'session' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Adminhtml\\Session\\Interceptor',
      ),
      'productCollectionFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\ResourceModel\\Product\\CollectionFactory',
      ),
      'sorting' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\Sorting',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'emulation' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\App\\Emulation',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'ruleFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\RuleFactory',
      ),
      'stockStatus' => 
      array (
        '_i_' => 'Magento\\CatalogInventory\\Model\\ResourceModel\\Stock\\Status',
      ),
      'searchRequestConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\Search\\Request\\Config',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\IndexDataProvider' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'productCollectionFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\ResourceModel\\Product\\CollectionFactory',
      ),
      'sorting' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\Sorting',
      ),
      'emulation' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\App\\Emulation',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'ruleFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\RuleFactory',
      ),
      'productPositionDataResource' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\ResourceModel\\Product',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting' => 
    array (
      'factory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\Sorting\\Factory',
      ),
      'improvedMethodBuilder' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\Sorting\\ImprovedSorting\\MethodBuilder',
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\Factory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\ImprovedSorting\\DummyMethod' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\ImprovedSorting\\DummyMethodFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\VisualMerch\\Model\\Product\\Sorting\\ImprovedSorting\\DummyMethod',
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\ImprovedSorting\\MethodBuilder' => 
    array (
      'dummyMethodFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\Sorting\\ImprovedSorting\\DummyMethodFactory',
      ),
      'methods' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\NameAscending' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\NameDescending' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\NewestTop' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\OutStockBottom' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\PriceAscending' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\PriceDescending' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\SortAbstract' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Product\\Sorting\\UserDefined' => 
    array (
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\ResourceModel\\Product' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\VisualMerch\\Model\\ResourceModel\\Product\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\VisualMerch\\Model\\ResourceModel\\Product\\Collection',
      ),
    ),
    'Amasty\\VisualMerch\\Model\\ResourceModel\\Product\\Indexer\\Eav\\Adapter' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'tableStrategy' => 
      array (
        '_ins_' => 'Magento\\Framework\\Indexer\\Table\\Strategy',
      ),
      'eavConfig' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\VisualMerch\\Model\\RuleFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\VisualMerch\\Model\\Rule',
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\AbstractCondition' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
      'categoryList' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Combine' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'conditionFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Rule\\Condition\\ProductFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\CombineFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => 'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Combine',
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Created' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'categoryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'entityAttributeSetCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\CollectionFactory',
      ),
      'eavConfig' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\InStock' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'string' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\StringUtils',
      ),
      'stockStatus' => 
      array (
        '_i_' => 'Magento\\CatalogInventory\\Model\\ResourceModel\\Stock\\Status',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\IsNew' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'string' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\StringUtils',
      ),
      'date' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime\\DateTime',
      ),
      'dateTime' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\IsNewByPeriod' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Price\\AbstractPrice' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Price\\FinalPrice' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Price\\Max' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Price\\Min' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Price\\Sale' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Product' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'categoryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'entityAttributeSetCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\CollectionFactory',
      ),
      'eavConfig' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\ProductFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => 'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Product',
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Qty' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'stockStatus' => 
      array (
        '_i_' => 'Magento\\CatalogInventory\\Model\\ResourceModel\\Stock\\Status',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Rule\\Condition\\Rating' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Rule\\Model\\Condition\\Context',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'productFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductFactory',
      ),
      'productRepository' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductRepository\\Interceptor',
      ),
      'productResource' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Product\\Interceptor',
      ),
      'attrSetCollection' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Set\\Collection',
      ),
      'localeFormat' => 
      array (
        '_i_' => 'Magento\\Framework\\Locale\\Format\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
          'form_name' => 'catalog_rule_form',
        ),
      ),
      'categoryList' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\VisualMerch\\Model\\Source\\Category' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Controller\\Adminhtml\\Category\\Add' => 
    array (
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Controller\\Adminhtml\\Category\\Edit' => 
    array (
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'productPositionDataResource' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\ResourceModel\\Product',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Model\\Indexer\\Category\\Product' => 
    array (
      'dataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\IndexDataProvider',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'categoryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'resource' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ResourceConnection\\Interceptor',
      ),
      'ruleFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\RuleFactory',
      ),
      'cacheContext' => 
      array (
        '_i_' => 'Magento\\Framework\\Indexer\\CacheContext',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'eavAttribute' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\ResourceModel\\Entity\\Attribute\\Interceptor',
      ),
      'appState' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\State\\Interceptor',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Model\\ResourceModel\\Category' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'ruleFactory' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\RuleFactory',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'adminhtmlDataProvider' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\Product\\AdminhtmlDataProvider',
      ),
      'productPositionDataResource' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Model\\ResourceModel\\Product',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Model\\ResourceModel\\Eav\\Attribute' => 
    array (
      'serializer' => 
      array (
        '_i_' => 'Amasty\\Base\\Model\\Serializer',
      ),
      'categoryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'eavConfig' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
      'categoryProductProcessor' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Processor',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Model\\ResourceModel\\Product' => 
    array (
      'categoryProductIndexerProcessor' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\Indexer\\Category\\Product\\Processor',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Model\\ResourceModel\\Product\\Indexer\\Price\\Configurable' => 
    array (
      'resourceConnection' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ResourceConnection\\Interceptor',
      ),
      'date' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Model\\ResourceModel\\Product\\Indexer\\Price\\DefaultPrice' => 
    array (
      'resourceConnection' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ResourceConnection\\Interceptor',
      ),
      'date' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Model\\ResourceModel\\Product\\Indexer\\Price\\Dimensional\\Configurable' => 
    array (
      'resourceConnection' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ResourceConnection\\Interceptor',
      ),
      'date' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'tableResolver' => 
      array (
        '_i_' => 'Magento\\Framework\\Indexer\\ScopeResolver\\IndexScopeResolver',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Catalog\\Model\\ResourceModel\\Product\\Indexer\\Price\\Dimensional\\Simple' => 
    array (
      'resourceConnection' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ResourceConnection\\Interceptor',
      ),
      'date' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'tableResolver' => 
      array (
        '_i_' => 'Magento\\Framework\\Indexer\\ScopeResolver\\IndexScopeResolver',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Xlanding\\Block\\Adminhtml\\Page\\Edit\\Tab\\Main' => 
    array (
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
    ),
    'Amasty\\VisualMerch\\Plugin\\Xlanding\\Model\\Indexer\\Catalog\\Category\\Product' => NULL,
    'Amasty\\VisualMerch\\Plugin\\Xlanding\\Model\\Page' => NULL,
    'Amasty\\VisualMerch\\Session\\StorageInterface' => 
    array (
      'namespace' => 
      array (
        '_v_' => 'amasty_visual_merch',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\VisualMerch\\Setup\\InstallData' => 
    array (
      'installAttributes' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Setup\\Operation\\InstallAttributes',
      ),
    ),
    'Amasty\\VisualMerch\\Setup\\InstallSchema' => NULL,
    'Amasty\\VisualMerch\\Setup\\Operation\\DisableIsRequiredOptionForMerchAttributes' => 
    array (
      'eavSetup' => 
      array (
        '_i_' => 'Magento\\Eav\\Setup\\EavSetup',
      ),
      'eavConfig' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
    ),
    'Amasty\\VisualMerch\\Setup\\Operation\\InstallAttributes' => 
    array (
      'eavSetup' => 
      array (
        '_i_' => 'Magento\\Eav\\Setup\\EavSetup',
      ),
      'eavConfig' => 
      array (
        '_i_' => 'Magento\\Eav\\Model\\Config',
      ),
    ),
    'Amasty\\VisualMerch\\Setup\\Operation\\RemoveStoreColumn' => NULL,
    'Amasty\\VisualMerch\\Setup\\UpgradeData' => 
    array (
      'resourceConfig' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\ResourceModel\\Config',
      ),
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem',
      ),
      'disableIsRequiredOptionForMerchAttributes' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Setup\\Operation\\DisableIsRequiredOptionForMerchAttributes',
      ),
    ),
    'Amasty\\VisualMerch\\Setup\\UpgradeSchema' => 
    array (
      'removeStoreColumn' => 
      array (
        '_i_' => 'Amasty\\VisualMerch\\Setup\\Operation\\RemoveStoreColumn',
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Widget\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Form' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Blog' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Brands' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Categories' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Extra' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Faq' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\General' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'store' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\System\\Store',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Landing' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Navigation' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'moduleManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\Manager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Pages' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tab\\Products' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'formFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\FormFactory',
      ),
      'yesnoFactory' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\Config\\Source\\YesnoFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'productType' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\Source\\ProductType',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\Sitemap\\Edit\\Tabs' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Template\\Context',
      ),
      'jsonEncoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Json\\Encoder',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Adminhtml\\System\\Config\\Information' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Backend\\Block\\Context',
      ),
      'authSession' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Auth\\Session\\Interceptor',
      ),
      'jsHelper' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Helper\\Js',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Block\\Robots' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Context',
      ),
      'sitemapCollection' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap\\Collection',
      ),
      'sitemapHelper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Helper\\Data' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Hreflang\\DataProvider' => 
    array (
      'getHreflangLanguageCodes' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\Hreflang\\GetLanguageCodes',
      ),
      'getHreflangUrls' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\Hreflang\\GetUrlsInterface',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Hreflang\\GetBaseStoreUrls' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Hreflang\\GetCmsPageRelationField' => 
    array (
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Hreflang\\GetLanguageCodes' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Hreflang\\XmlTagsProvider' => 
    array (
      'getCmsPageRelationField' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\Hreflang\\GetCmsPageRelationField',
      ),
      'hreflangProviders' => 
      array (
        '_vac_' => 
        array (
          'product' => 
          array (
            '_i_' => 'hreflangProductProvider',
          ),
          'category' => 
          array (
            '_i_' => 'hreflangCategoryProvider',
          ),
          'cms_page' => 
          array (
            '_i_' => 'hreflangCmsProvider',
          ),
        ),
      ),
      'currentStoreId' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Hreflang\\XmlTagsProviderFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Observer' => 
    array (
      'sitemapCollection' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap\\CollectionFactory',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Repository\\SitemapRepository' => 
    array (
      'searchResultsFactory' => 
      array (
        '_i_' => 'Magento\\Ui\\Api\\Data\\BookmarkSearchResultsInterfaceFactory',
      ),
      'sitemapFactory' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\SitemapFactory',
      ),
      'sitemapResource' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap',
      ),
      'sitemapCollectionFactory' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap\\CollectionFactory',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\ResourceModel\\Hreflang\\GetCategoryUrls' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'getBaseStoreUrls' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\Hreflang\\GetBaseStoreUrls',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\ResourceModel\\Hreflang\\GetCmsUrls' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'getBaseStoreUrls' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\Hreflang\\GetBaseStoreUrls',
      ),
      'metadataPool' => 
      array (
        '_i_' => 'Magento\\Framework\\EntityManager\\MetadataPool',
      ),
      'getCmsPageRelationField' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\Hreflang\\GetCmsPageRelationField',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\ResourceModel\\Hreflang\\GetProductUrls' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'getBaseStoreUrls' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Model\\Hreflang\\GetBaseStoreUrls',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\ResourceModel\\SitemapFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap\\Collection',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\ResourceModel\\Sitemap\\Grid\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'mainTable' => 
      array (
        '_v_' => 'amasty_xml_sitemap',
      ),
      'eventPrefix' => 
      array (
        '_v_' => 'amasty_xml_sitemap_grid_collection',
      ),
      'eventObject' => 
      array (
        '_v_' => 'sitemap_grid_collection',
      ),
      'resourceModel' => 
      array (
        '_v_' => 'Amasty\\Rma\\Model\\ResourceModel\\Status',
      ),
      'model' => 
      array (
        '_v_' => 'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\Document',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\SitemapFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amasty\\XmlSitemap\\Model\\Sitemap',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Source\\Hreflang\\CmsRelation' => NULL,
    'Amasty\\XmlSitemap\\Model\\Source\\Hreflang\\Country' => 
    array (
      'countrySource' => 
      array (
        '_i_' => 'Magento\\Directory\\Model\\Config\\Source\\Country\\Full',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Source\\Hreflang\\Language' => NULL,
    'Amasty\\XmlSitemap\\Model\\Source\\Hreflang\\Scope' => NULL,
    'Amasty\\XmlSitemap\\Model\\Source\\Hreflang\\Xdefault' => 
    array (
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amasty\\XmlSitemap\\Model\\Source\\ProductType' => 
    array (
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
    ),
    'Amasty\\XmlSitemap\\Plugin\\Store\\Model\\Store' => 
    array (
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
    ),
    'Amasty\\XmlSitemap\\Setup\\InstallData' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
    ),
    'Amasty\\XmlSitemap\\Setup\\InstallSchema' => NULL,
    'Amasty\\XmlSitemap\\Setup\\UpgradeSchema' => 
    array (
      'addProductType' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Setup\\UpgradeSchema\\AddProductType',
      ),
    ),
    'Amasty\\XmlSitemap\\Setup\\UpgradeSchema\\AddProductType' => NULL,
    'Amasty\\XmlSitemap\\Ui\\Component\\Listing\\Column\\Actions' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\Context',
      ),
      'uiComponentFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponentFactory',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'components' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amasty\\XmlSitemap\\Ui\\Component\\Listing\\Column\\Url' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponent\\Context',
      ),
      'uiComponentFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\UiComponentFactory',
      ),
      'helper' => 
      array (
        '_i_' => 'Amasty\\XmlSitemap\\Helper\\Data',
      ),
      'ioFile' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem\\Io\\File',
      ),
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem',
      ),
      'components' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'AmazonAuthorizationValidators' => 
    array (
      'resultFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Validator\\ResultInterfaceFactory',
      ),
      'tmapFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManager\\TMapFactory',
      ),
      'validators' => 
      array (
        '_v_' => 
        array (
          'contraints' => 'Amazon\\Payment\\Gateway\\Validator\\ConstraintValidator',
          'authcodes' => 'Amazon\\Payment\\Gateway\\Validator\\AuthorizationValidator',
        ),
      ),
      'chainBreakingValidators' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'AmazonAuthorizeCommand' => 
    array (
      'requestBuilder' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Request\\AuthorizationRequestBuilder',
      ),
      'transferFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\TransferFactory',
      ),
      'client' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\Client\\AuthorizeClient',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'handler' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Response\\CompleteAuthHandler',
      ),
      'validator' => 
      array (
        '_i_' => 'AmazonAuthorizationValidators',
      ),
      'errorMessageMapper' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualErrorMessageMapper',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'exceptionLogger' => 
      array (
        '_vn_' => true,
      ),
    ),
    'AmazonCaptureStrategyCommand' => 
    array (
      'commandPool' => 
      array (
        '_i_' => 'AmazonCommandPool',
      ),
      'transactionRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Transaction\\Repository',
      ),
      'searchCriteriaBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilder',
      ),
      'filterBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\FilterBuilder',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'orderAdapterFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Data\\Order\\OrderAdapterFactory',
      ),
      'exceptionLogger' => 
      array (
        '_vn_' => true,
      ),
    ),
    'AmazonCommandManager' => 
    array (
      'commandPool' => 
      array (
        '_i_' => 'AmazonCommandPool',
      ),
      'paymentDataObjectFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Data\\PaymentDataObjectFactory',
      ),
    ),
    'AmazonCommandPool' => 
    array (
      'tmapFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManager\\TMapFactory',
      ),
      'commands' => 
      array (
        '_v_' => 
        array (
          'authorize' => 'AmazonAuthorizeCommand',
          'capture' => 'AmazonCaptureStrategyCommand',
          'sale' => 'AmazonSaleCommand',
          'settlement' => 'AmazonSettlementCommand',
          'void' => 'AmazonVoidCommand',
          'cancel' => 'AmazonVoidCommand',
          'refund' => 'AmazonRefundCommand',
        ),
      ),
    ),
    'AmazonConfigValueHandler' => 
    array (
      'configInterface' => 
      array (
        '_i_' => 'AmazonGatewayConfig',
      ),
    ),
    'AmazonCountryValidator' => 
    array (
      'resultFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Validator\\ResultInterfaceFactory',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
    ),
    'AmazonCurrencyValidator' => 
    array (
      'resultFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Validator\\ResultInterfaceFactory',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'AmazonFacade' => 
    array (
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'valueHandlerPool' => 
      array (
        '_i_' => 'AmazonValueHandlerPool',
      ),
      'paymentDataObjectFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Data\\PaymentDataObjectFactory',
      ),
      'code' => 
      array (
        '_v_' => 'amazon_payment',
      ),
      'formBlockType' => 
      array (
        '_v_' => 'Magento\\Payment\\Block\\Form',
      ),
      'infoBlockType' => 
      array (
        '_v_' => 'Magento\\Payment\\Block\\Info',
      ),
      'commandPool' => 
      array (
        '_i_' => 'AmazonCommandPool',
      ),
      'validatorPool' => 
      array (
        '_i_' => 'AmazonValidatorPool',
      ),
      'commandExecutor' => 
      array (
        '_vn_' => true,
      ),
      'logger' => 
      array (
        '_vn_' => true,
      ),
    ),
    'AmazonGatewayConfig' => 
    array (
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'methodCode' => 
      array (
        '_v_' => 'amazon_payment',
      ),
      'pathPattern' => 
      array (
        '_v_' => 'payment/%s/%s',
      ),
    ),
    'AmazonLogger' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\VirtualLogger',
      ),
      'config' => 
      array (
        '_i_' => 'AmazonGatewayConfig',
      ),
    ),
    'AmazonRefundCommand' => 
    array (
      'requestBuilder' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Request\\RefundRequestBuilder',
      ),
      'transferFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\TransferFactory',
      ),
      'client' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\Client\\RefundClient',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'handler' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Response\\RefundHandler',
      ),
      'validator' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Validator\\AuthorizationValidator',
      ),
      'errorMessageMapper' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualErrorMessageMapper',
      ),
    ),
    'AmazonSaleCommand' => 
    array (
      'requestBuilder' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Request\\AuthorizationRequestBuilder',
      ),
      'transferFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\TransferFactory',
      ),
      'client' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\Client\\CaptureClient',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'handler' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Response\\CompleteSaleHandler',
      ),
      'validator' => 
      array (
        '_i_' => 'AmazonAuthorizationValidators',
      ),
      'errorMessageMapper' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualErrorMessageMapper',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'exceptionLogger' => 
      array (
        '_vn_' => true,
      ),
    ),
    'AmazonSettlementCommand' => 
    array (
      'requestBuilder' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Request\\SettlementRequestBuilder',
      ),
      'transferFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\TransferFactory',
      ),
      'client' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\Client\\SettlementClient',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'handler' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Response\\SettlementHandler',
      ),
      'validator' => 
      array (
        '_i_' => 'AmazonAuthorizationValidators',
      ),
      'errorMessageMapper' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualErrorMessageMapper',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'exceptionLogger' => 
      array (
        '_vn_' => true,
      ),
    ),
    'AmazonValidatorPool' => 
    array (
      'tmapFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManager\\TMapFactory',
      ),
      'validators' => 
      array (
        '_v_' => 
        array (
          'country' => 'AmazonCountryValidator',
          'currency' => 'AmazonCurrencyValidator',
        ),
      ),
    ),
    'AmazonValueHandlerPool' => 
    array (
      'tmapFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManager\\TMapFactory',
      ),
      'handlers' => 
      array (
        '_v_' => 
        array (
          'default' => 'AmazonConfigValueHandler',
        ),
      ),
    ),
    'AmazonVoidCommand' => 
    array (
      'requestBuilder' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Request\\VoidRequestBuilder',
      ),
      'transferFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\TransferFactory',
      ),
      'client' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Http\\Client\\VoidClient',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'handler' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Response\\VoidHandler',
      ),
      'validator' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Validator\\AuthorizationValidator',
      ),
      'errorMessageMapper' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualErrorMessageMapper',
      ),
    ),
    'Amazon\\Core\\Block\\Adminhtml\\Form\\Field\\CategoryMultiselect' => 
    array (
      'factoryElement' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Form\\Element\\Factory',
      ),
      'factoryCollection' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Form\\Element\\CollectionFactory',
      ),
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ResourceModel\\Category\\CollectionFactory',
      ),
      'backendData' => 
      array (
        '_i_' => 'Magento\\Backend\\Helper\\Data',
      ),
      'layout' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Layout\\Interceptor',
      ),
      'jsonEncoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Json\\Encoder',
      ),
      'authorization' => 
      array (
        '_i_' => 'Magento\\Framework\\Authorization\\Interceptor',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Core\\Block\\Adminhtml\\System\\Config\\SimplePathAdmin' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'simplePath' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\Config\\SimplePath',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Core\\Block\\Config' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\AmazonConfig',
      ),
      'url' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Url',
      ),
      'categoryExclusionHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\CategoryExclusion',
      ),
    ),
    'Amazon\\Core\\Client\\Client' => 
    array (
      'amazonConfig' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Core\\Client\\ClientFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'logger' => 
      array (
        '_i_' => 'Amazon\\Core\\Logger\\Logger',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\AmazonPay\\ClientInterface',
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonAddress' => 
    array (
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonAddressDecoratorDe' => 
    array (
      'amazonAddress' => 
      array (
        '_i_' => 'Amazon\\Core\\Domain\\AmazonAddress',
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonAddressDecoratorJp' => 
    array (
      'amazonAddress' => 
      array (
        '_i_' => 'Amazon\\Core\\Domain\\AmazonAddress',
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonAddressFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'amazonNameFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Domain\\AmazonNameFactory',
      ),
      'escaper' => 
      array (
        '_vn_' => true,
      ),
      'addressDecoratorPool' => 
      array (
        '_v_' => 
        array (
          'DE' => 'Amazon\\Core\\Domain\\AmazonAddressDecoratorDe',
          'AT' => 'Amazon\\Core\\Domain\\AmazonAddressDecoratorDe',
          'JP' => 'Amazon\\Core\\Domain\\AmazonAddressDecoratorJp',
        ),
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonCustomer' => 
    array (
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonCustomerFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'amazonNameFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Domain\\AmazonNameFactory',
      ),
      'escaper' => 
      array (
        '_i_' => 'Magento\\Framework\\Escaper',
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonName' => 
    array (
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonNameDecoratorJp' => 
    array (
      'amazonName' => 
      array (
        '_i_' => 'Amazon\\Core\\Domain\\AmazonName',
      ),
    ),
    'Amazon\\Core\\Domain\\AmazonNameFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'amazonName' => 
      array (
        '_i_' => 'Amazon\\Core\\Domain\\AmazonName',
      ),
      'perCountryNameHandlers' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Core\\Exception\\AmazonServiceUnavailableException' => 
    array (
      'apiErrorType' => 
      array (
        '_v_' => '',
      ),
      'apiErrorCode' => 
      array (
        '_v_' => '',
      ),
      'apiErrorMessage' => 
      array (
        '_v_' => '',
      ),
    ),
    'Amazon\\Core\\Exception\\AmazonWebapiException' => 
    array (
      'phrase' => 
      array (
        '_i_' => 'Magento\\Framework\\Phrase',
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
      'httpCode' => 
      array (
        '_v_' => 400,
      ),
      'details' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'name' => 
      array (
        '_v_' => '',
      ),
      'errors' => 
      array (
        '_vn_' => true,
      ),
      'stackTrace' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Core\\Helper\\CategoryExclusion' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'checkoutSession' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Proxy',
      ),
    ),
    'Amazon\\Core\\Helper\\ClientIp' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
    ),
    'Amazon\\Core\\Helper\\ClientIp\\Proxy' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Core\\Helper\\ClientIp',
      ),
      'shared' => 
      array (
        '_v_' => true,
      ),
    ),
    'Amazon\\Core\\Helper\\Data' => 
    array (
      'moduleList' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\ModuleList',
      ),
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'encryptor' => 
      array (
        '_i_' => 'Magento\\Framework\\Encryption\\Encryptor',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManagerInterface\\Proxy',
      ),
      'clientIpHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\ClientIp\\Proxy',
      ),
      'moduleStatusFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\StatusFactory',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\AmazonConfig',
      ),
    ),
    'Amazon\\Core\\Logger\\ExceptionLogger' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Amazon\\Core\\Logger\\Logger',
      ),
    ),
    'Amazon\\Core\\Logger\\Handler\\Client' => 
    array (
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem\\Driver\\File',
      ),
      'filePath' => 
      array (
        '_vn_' => true,
      ),
      'fileName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Core\\Logger\\Handler\\Ipn' => 
    array (
      'filesystem' => 
      array (
        '_i_' => 'Magento\\Framework\\Filesystem\\Driver\\File',
      ),
      'filePath' => 
      array (
        '_vn_' => true,
      ),
      'fileName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Core\\Logger\\IpnLogger' => 
    array (
      'name' => 
      array (
        '_v_' => 'amazonIpnLogger',
      ),
      'handlers' => 
      array (
        '_vac_' => 
        array (
          'debug' => 
          array (
            '_i_' => 'Amazon\\Core\\Logger\\Handler\\Ipn',
          ),
        ),
      ),
      'processors' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Core\\Logger\\Logger' => 
    array (
      'name' => 
      array (
        '_v_' => 'amazonClientLogger',
      ),
      'handlers' => 
      array (
        '_vac_' => 
        array (
          'debug' => 
          array (
            '_i_' => 'Amazon\\Core\\Logger\\Handler\\Client',
          ),
        ),
      ),
      'processors' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Core\\Model\\AmazonConfig' => 
    array (
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
    ),
    'Amazon\\Core\\Model\\Config\\Credentials\\Json' => 
    array (
      'amazonCoreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'jsonConfigDataValidator' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\Validation\\JsonConfigDataValidatorFactory',
      ),
      'configWriter' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\ResourceModel\\Config',
      ),
      'messageManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Message\\Manager',
      ),
      'jsonDecoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Json\\Decoder',
      ),
      'encryptor' => 
      array (
        '_i_' => 'Magento\\Framework\\Encryption\\Encryptor',
      ),
      'simplePath' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\Config\\SimplePath',
      ),
    ),
    'Amazon\\Core\\Model\\Config\\SimplePath' => 
    array (
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'amazonConfig' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\AmazonConfig',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Config\\Model\\ResourceModel\\Config',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'productMeta' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'encryptor' => 
      array (
        '_i_' => 'Magento\\Framework\\Encryption\\Encryptor',
      ),
      'messageManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Message\\Manager',
      ),
      'connection' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ResourceConnection\\Interceptor',
      ),
      'cacheManager' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Manager',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'state' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\State\\Interceptor',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'backendUrl' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'paypal' => 
      array (
        '_i_' => 'Magento\\Paypal\\Model\\Config',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
    ),
    'Amazon\\Core\\Model\\Config\\Source\\AuthorizationMode' => NULL,
    'Amazon\\Core\\Model\\Config\\Source\\Button\\Color' => NULL,
    'Amazon\\Core\\Model\\Config\\Source\\Button\\Size' => NULL,
    'Amazon\\Core\\Model\\Config\\Source\\Button\\Type' => NULL,
    'Amazon\\Core\\Model\\Config\\Source\\PaymentAction' => NULL,
    'Amazon\\Core\\Model\\Config\\Source\\PaymentRegion' => NULL,
    'Amazon\\Core\\Model\\Config\\Source\\UpdateMechanism' => NULL,
    'Amazon\\Core\\Model\\Validation\\AddressBlacklistTermsValidator' => 
    array (
      'amazonCoreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Core\\Model\\Validation\\ApiCredentialsValidator' => 
    array (
      'amazonHttpClientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'amazonCoreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Core\\Model\\Validation\\ApiCredentialsValidatorFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Core\\Model\\Validation\\ApiCredentialsValidator',
      ),
    ),
    'Amazon\\Core\\Model\\Validation\\JsonConfigDataValidator' => 
    array (
      'amazonCoreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'jsonDecoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Json\\Decoder',
      ),
    ),
    'Amazon\\Core\\Model\\Validation\\JsonConfigDataValidatorFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Core\\Model\\Validation\\JsonConfigDataValidator',
      ),
    ),
    'Amazon\\Core\\Observer\\ExcludedCategoryQuoteItemAddition' => 
    array (
      'categoryExclusionHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\CategoryExclusion',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Core\\Observer\\PaymentConfigSaveAfter' => 
    array (
      'apiCredentialsValidatorFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\Validation\\ApiCredentialsValidatorFactory',
      ),
      'messageManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Message\\Manager',
      ),
      'jsonCredentials' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\Config\\Credentials\\Json',
      ),
      'amazonCoreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ReinitableConfig\\Interceptor',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
    ),
    'Amazon\\Core\\Plugin\\CartSection' => 
    array (
      'categoryExclusionHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\CategoryExclusion',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Core\\Setup\\UpgradeData' => NULL,
    'Amazon\\Login\\Api\\Data\\CustomerLinkSearchResultsInterfaceFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Login\\Api\\Data\\CustomerLinkSearchResultsInterface',
      ),
    ),
    'Amazon\\Login\\Block\\Login' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Login\\Block\\OAuthRedirect' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'amazonCoreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Login\\Block\\Validate' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Login\\Domain\\LayoutConfig' => 
    array (
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Login\\Domain\\ValidationCredentials' => 
    array (
      'customerId' => 
      array (
        '_vn_' => true,
      ),
      'amazonId' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Login\\Helper\\Session' => 
    array (
      'session' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Proxy',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'checkoutSession' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Interceptor',
      ),
    ),
    'Amazon\\Login\\Model\\CheckoutConfigProvider' => 
    array (
      'customerSession' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Interceptor',
      ),
      'checkoutSession' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Interceptor',
      ),
    ),
    'Amazon\\Login\\Model\\CheckoutConfigProvider\\Proxy' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Login\\Model\\CheckoutConfigProvider',
      ),
      'shared' => 
      array (
        '_v_' => true,
      ),
    ),
    'Amazon\\Login\\Model\\CustomerLink' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Login\\Model\\CustomerLinkFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Login\\Model\\CustomerLink',
      ),
    ),
    'Amazon\\Login\\Model\\CustomerLinkManagement' => 
    array (
      'customerLinkRepository' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\CustomerLinkRepository',
      ),
      'customerLinkFactory' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\CustomerLinkFactory',
      ),
      'customerInterface' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Data\\Customer',
      ),
      'customerDataFactory' => 
      array (
        '_i_' => 'Magento\\Customer\\Api\\Data\\CustomerInterfaceFactory',
      ),
      'accountManagement' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\AccountManagement\\Interceptor',
      ),
      'random' => 
      array (
        '_i_' => 'Magento\\Framework\\Math\\Random',
      ),
    ),
    'Amazon\\Login\\Model\\CustomerLinkRepository' => 
    array (
      'resourceModel' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\ResourceModel\\CustomerLink',
      ),
      'customerLinkFactory' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\CustomerLinkFactory',
      ),
      'filterBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\FilterBuilder',
      ),
      'searchCriteriaBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilder',
      ),
      'searchResultsFactory' => 
      array (
        '_i_' => 'Amazon\\Login\\Api\\Data\\CustomerLinkSearchResultsInterfaceFactory',
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\ResourceModel\\CustomerLink\\CollectionFactory',
      ),
      'collectionProcessor' => 
      array (
        '_i_' => 'Magento\\Framework\\Api\\SearchCriteria\\CollectionProcessor',
      ),
    ),
    'Amazon\\Login\\Model\\CustomerManagement' => 
    array (
      'customerLinkManagement' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\CustomerLinkManagement',
      ),
      'customerExtensionFactory' => 
      array (
        '_i_' => 'Magento\\Customer\\Api\\Data\\CustomerExtensionFactory',
      ),
    ),
    'Amazon\\Login\\Model\\Customer\\Account\\Redirect' => 
    array (
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'customerSession' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Proxy',
      ),
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'url' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'urlDecoder' => 
      array (
        '_i_' => 'Magento\\Framework\\Url\\Decoder',
      ),
      'customerUrl' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Url',
      ),
      'resultFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Controller\\ResultFactory',
      ),
      'checkoutSession' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Proxy',
      ),
    ),
    'Amazon\\Login\\Model\\Customer\\CompositeMatcher' => 
    array (
      'matchers' => 
      array (
        '_vac_' => 
        array (
          'sessionmatcher' => 
          array (
            '_i_' => 'Amazon\\Login\\Model\\Customer\\SessionMatcher',
          ),
          'idmatcher' => 
          array (
            '_i_' => 'Amazon\\Login\\Model\\Customer\\IdMatcher',
          ),
          'emailmatcher' => 
          array (
            '_i_' => 'Amazon\\Login\\Model\\Customer\\EmailMatcher',
          ),
        ),
      ),
    ),
    'Amazon\\Login\\Model\\Customer\\EmailMatcher' => 
    array (
      'customerRepository' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\ResourceModel\\CustomerRepository\\Interceptor',
      ),
    ),
    'Amazon\\Login\\Model\\Customer\\IdMatcher' => 
    array (
      'customerRepository' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\ResourceModel\\CustomerRepository\\Interceptor',
      ),
      'searchCriteriaBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilder',
      ),
    ),
    'Amazon\\Login\\Model\\Customer\\SessionMatcher' => 
    array (
      'session' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Interceptor',
      ),
    ),
    'Amazon\\Login\\Model\\ResourceModel\\CustomerLink' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Login\\Model\\ResourceModel\\CustomerLink\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Login\\Model\\ResourceModel\\CustomerLink\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Login\\Model\\ResourceModel\\CustomerLink\\Collection',
      ),
    ),
    'Amazon\\Login\\Model\\Validator\\AccessTokenRequestValidator' => NULL,
    'Amazon\\Login\\Observer\\AmazonCustomerAuthenticated' => 
    array (
      'sessionHelper' => 
      array (
        '_i_' => 'Amazon\\Login\\Helper\\Session',
      ),
    ),
    'Amazon\\Login\\Observer\\SetAuthorizeErrorCookie' => 
    array (
      'cookieManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\Cookie\\PhpCookieManager',
      ),
      'cookieMetadataFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\Cookie\\CookieMetadataFactory',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Login\\Observer\\SetLogoutCookie' => 
    array (
      'cookieManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\Cookie\\PhpCookieManager',
      ),
      'cookieMetadataFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\Cookie\\CookieMetadataFactory',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Login\\Plugin\\CartController' => 
    array (
      'session' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Interceptor',
      ),
      'url' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
    ),
    'Amazon\\Login\\Plugin\\CheckoutController' => 
    array (
      'session' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Interceptor',
      ),
      'url' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
    ),
    'Amazon\\Login\\Plugin\\CreateController' => 
    array (
      'session' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Interceptor',
      ),
      'url' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Url',
      ),
    ),
    'Amazon\\Login\\Plugin\\CustomerCollection' => 
    array (
      'amazonHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Login\\Plugin\\CustomerRepository' => 
    array (
      'customerManagement' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\CustomerManagement',
      ),
      'amazonHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Login\\Plugin\\LoginController' => 
    array (
      'session' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Interceptor',
      ),
      'url' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Url',
      ),
    ),
    'Amazon\\Login\\Plugin\\OrderCustomerManagement' => 
    array (
      'loginSessionHelper' => 
      array (
        '_i_' => 'Amazon\\Login\\Helper\\Session',
      ),
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
      'customerLinkManagement' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\CustomerLinkManagement',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Login\\Setup\\InstallSchema' => NULL,
    'Amazon\\Login\\Setup\\UpgradeSchema' => NULL,
    'Amazon\\Payment\\Api\\Data\\OrderLinkInterfaceFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Api\\Data\\OrderLinkInterface',
      ),
    ),
    'Amazon\\Payment\\Api\\Data\\PendingAuthorizationInterfaceFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Api\\Data\\PendingAuthorizationInterface',
      ),
    ),
    'Amazon\\Payment\\Api\\Data\\PendingCaptureInterfaceFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Api\\Data\\PendingCaptureInterface',
      ),
    ),
    'Amazon\\Payment\\Api\\Data\\PendingRefundInterfaceFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Api\\Data\\PendingRefundInterface',
      ),
    ),
    'Amazon\\Payment\\Api\\Data\\QuoteLinkInterfaceFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Api\\Data\\QuoteLinkInterface',
      ),
    ),
    'Amazon\\Payment\\Block\\Minicart\\Button' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'localeResolver' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Locale\\Resolver',
      ),
      'mainHelper' => 
      array (
        '_i_' => 'Amazon\\Payment\\Helper\\Data',
      ),
      'session' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Interceptor',
      ),
      'payment' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'request' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Request\\Http',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Block\\PaymentLink' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'categoryExclusionHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\CategoryExclusion',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Block\\ProductPagePaymentLink' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'categoryExclusionHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\CategoryExclusion',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Block\\Widget\\ResetPassword' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\View\\Element\\Template\\Context',
      ),
      'urlModel' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Url',
      ),
      'session' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\Session\\Interceptor',
      ),
      'customerLink' => 
      array (
        '_i_' => 'Amazon\\Login\\Model\\CustomerLinkRepository',
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Cron\\GetAmazonAuthorizationUpdates' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\ResourceModel\\PendingAuthorization\\CollectionFactory',
      ),
      'authorization' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\PaymentManagement\\Authorization',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'transactionRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Transaction\\Repository',
      ),
      'searchBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilder',
      ),
      'filterBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\FilterBuilder',
      ),
      'filterGroup' => 
      array (
        '_i_' => 'Magento\\Framework\\Api\\Search\\FilterGroup',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'limit' => 
      array (
        '_v_' => 100,
      ),
    ),
    'Amazon\\Payment\\Cron\\GetAmazonCaptureUpdates' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\ResourceModel\\PendingCapture\\CollectionFactory',
      ),
      'capture' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\PaymentManagement\\Capture',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'transactionRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Transaction\\Repository',
      ),
      'searchBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilder',
      ),
      'filterBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\FilterBuilder',
      ),
      'filterGroup' => 
      array (
        '_i_' => 'Magento\\Framework\\Api\\Search\\FilterGroup',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'limit' => 
      array (
        '_v_' => 100,
      ),
    ),
    'Amazon\\Payment\\Cron\\ProcessAmazonRefunds' => 
    array (
      'collectionFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\ResourceModel\\PendingRefund\\CollectionFactory',
      ),
      'queuedRefundUpdater' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\QueuedRefundUpdaterFactory',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'limit' => 
      array (
        '_v_' => 100,
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonAuthorizationDetailsResponse' => 
    array (
      'response' => 
      array (
        '_i_' => 'AmazonPay\\ResponseInterface',
      ),
      'amazonAuthorizationDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonAuthorizationDetailsFactory',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonAuthorizationDetailsResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonAuthorizationDetailsResponse',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonAuthorizationResponse' => 
    array (
      'response' => 
      array (
        '_i_' => 'AmazonPay\\ResponseInterface',
      ),
      'amazonAuthorizationDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonAuthorizationDetailsFactory',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonAuthorizationResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonAuthorizationResponse',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonAuthorizationStatus' => 
    array (
      'state' => 
      array (
        '_vn_' => true,
      ),
      'reasonCode' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonAuthorizationStatusFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonAuthorizationStatus',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonCaptureDetailsResponse' => 
    array (
      'response' => 
      array (
        '_i_' => 'AmazonPay\\ResponseInterface',
      ),
      'amazonCaptureDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonCaptureDetailsFactory',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonCaptureDetailsResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonCaptureDetailsResponse',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonCaptureResponse' => 
    array (
      'response' => 
      array (
        '_i_' => 'AmazonPay\\ResponseInterface',
      ),
      'amazonCaptureDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonCaptureDetailsFactory',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonCaptureResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonCaptureResponse',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonCaptureStatus' => 
    array (
      'state' => 
      array (
        '_vn_' => true,
      ),
      'reasonCode' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonCaptureStatusFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonCaptureStatus',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonConstraint' => 
    array (
      'id' => 
      array (
        '_vn_' => true,
      ),
      'description' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonConstraintFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonConstraint',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonGetOrderDetailsResponse' => 
    array (
      'response' => 
      array (
        '_i_' => 'AmazonPay\\ResponseInterface',
      ),
      'amazonOrderDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonOrderDetailsFactory',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonGetOrderDetailsResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonGetOrderDetailsResponse',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonOrderStatus' => 
    array (
      'state' => 
      array (
        '_vn_' => true,
      ),
      'reasonCode' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonOrderStatusFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonOrderStatus',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonRefundDetailsResponse' => 
    array (
      'response' => 
      array (
        '_i_' => 'AmazonPay\\ResponseInterface',
      ),
      'amazonRefundDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonRefundDetailsFactory',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonRefundDetailsResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonRefundDetailsResponse',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonRefundResponse' => 
    array (
      'response' => 
      array (
        '_i_' => 'AmazonPay\\ResponseInterface',
      ),
      'amazonRefundDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonRefundDetailsFactory',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonRefundResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonRefundResponse',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonRefundStatus' => 
    array (
      'state' => 
      array (
        '_vn_' => true,
      ),
      'reasonCode' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonRefundStatusFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonRefundStatus',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonSetOrderDetailsResponse' => 
    array (
      'response' => 
      array (
        '_i_' => 'AmazonPay\\ResponseInterface',
      ),
      'amazonConstraintFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonConstraintFactory',
      ),
    ),
    'Amazon\\Payment\\Domain\\AmazonSetOrderDetailsResponseFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\AmazonSetOrderDetailsResponse',
      ),
    ),
    'Amazon\\Payment\\Domain\\Details\\AmazonAuthorizationDetails' => 
    array (
      'amazonAuthorizationStatusFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonAuthorizationStatusFactory',
      ),
      'details' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\Details\\AmazonAuthorizationDetailsFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\Details\\AmazonAuthorizationDetails',
      ),
    ),
    'Amazon\\Payment\\Domain\\Details\\AmazonCaptureDetails' => 
    array (
      'amazonCaptureStatusFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonCaptureStatusFactory',
      ),
      'details' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\Details\\AmazonCaptureDetailsFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\Details\\AmazonCaptureDetails',
      ),
    ),
    'Amazon\\Payment\\Domain\\Details\\AmazonOrderDetails' => 
    array (
      'amazonOrderStatusFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonOrderStatusFactory',
      ),
      'details' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\Details\\AmazonOrderDetailsFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\Details\\AmazonOrderDetails',
      ),
    ),
    'Amazon\\Payment\\Domain\\Details\\AmazonRefundDetails' => 
    array (
      'amazonRefundStatusFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonRefundStatusFactory',
      ),
      'details' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Domain\\Details\\AmazonRefundDetailsFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Domain\\Details\\AmazonRefundDetails',
      ),
    ),
    'Amazon\\Payment\\Domain\\Validator\\AmazonAuthorization' => NULL,
    'Amazon\\Payment\\Exception\\AuthorizationExpiredException' => 
    array (
      'message' => 
      array (
        '_v_' => '',
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
      'previous' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Exception\\CapturePendingException' => 
    array (
      'message' => 
      array (
        '_v_' => '',
      ),
      'code' => 
      array (
        '_v_' => 0,
      ),
      'previous' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Exception\\HardDeclineException' => 
    array (
      'phrase' => 
      array (
        '_i_' => 'Magento\\Framework\\Phrase',
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Exception\\SoftDeclineException' => 
    array (
      'phrase' => 
      array (
        '_i_' => 'Magento\\Framework\\Phrase',
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Exception\\TransactionTimeoutException' => 
    array (
      'phrase' => 
      array (
        '_i_' => 'Magento\\Framework\\Phrase',
      ),
      'cause' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Gateway\\Command\\AmazonAuthCommand' => 
    array (
      'requestBuilder' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Request\\BuilderInterface',
      ),
      'transferFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Http\\TransferFactoryInterface',
      ),
      'client' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Http\\ClientInterface',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'handler' => 
      array (
        '_vn_' => true,
      ),
      'validator' => 
      array (
        '_vn_' => true,
      ),
      'errorMessageMapper' => 
      array (
        '_vn_' => true,
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'exceptionLogger' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Gateway\\Command\\CaptureStrategyCommand' => 
    array (
      'commandPool' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Command\\CommandPoolInterface',
      ),
      'transactionRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Transaction\\Repository',
      ),
      'searchCriteriaBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilder',
      ),
      'filterBuilder' => 
      array (
        '_ins_' => 'Magento\\Framework\\Api\\FilterBuilder',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'orderAdapterFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Data\\Order\\OrderAdapterFactory',
      ),
      'exceptionLogger' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Gateway\\Config\\Config' => 
    array (
      'scopeConfig' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
      'methodCode' => 
      array (
        '_v_' => 'amazon_payment',
      ),
      'pathPattern' => 
      array (
        '_v_' => 'payment/%s/%s',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Data\\Order\\OrderAdapter' => 
    array (
      'order' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Interceptor',
      ),
      'addressAdapterFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Data\\Order\\AddressAdapterFactory',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\AmazonConfig',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Data\\Order\\OrderAdapterFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Gateway\\Data\\Order\\OrderAdapter',
      ),
    ),
    'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualConfigReader' => 
    array (
      'fileResolver' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\FileResolver',
      ),
      'converter' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\ErrorMapper\\XmlToArrayConverter',
      ),
      'schemaLocator' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\ErrorMapper\\VirtualSchemaLocator',
      ),
      'validationState' => 
      array (
        '_i_' => 'MiraklSeller\\Process\\Model\\ValidationState',
      ),
      'fileName' => 
      array (
        '_v_' => 'amazon_error_mapping.xml',
      ),
      'idAttributes' => 
      array (
        '_v_' => 
        array (
        ),
      ),
      'domDocumentClass' => 
      array (
        '_v_' => 'Magento\\Framework\\Config\\Dom',
      ),
      'defaultScope' => 
      array (
        '_v_' => 'global',
      ),
    ),
    'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualErrorMessageMapper' => 
    array (
      'messageMapping' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualMappingData',
      ),
    ),
    'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualMappingData' => 
    array (
      'reader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\ErrorMapper\\VirtualConfigReader',
      ),
      'configScope' => 
      array (
        '_i_' => 'Magento\\Framework\\Config\\Scope',
      ),
      'cache' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Cache\\Type\\Config',
      ),
      'cacheId' => 
      array (
        '_v_' => 'amazon_error_mapper',
      ),
      'serializer' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Gateway\\Helper\\SubjectReader' => 
    array (
      'checkoutSession' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Interceptor',
      ),
      'quoteLinkInterfaceFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\QuoteLinkInterfaceFactory',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Http\\Client\\AuthorizeClient' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'adapter' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\Adapter\\AmazonPaymentAdapter',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Http\\Client\\CaptureClient' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'adapter' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\Adapter\\AmazonPaymentAdapter',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Http\\Client\\RefundClient' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'refundResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonRefundResponseFactory',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Http\\Client\\SettlementClient' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'adapter' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\Adapter\\AmazonPaymentAdapter',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Http\\Client\\VoidClient' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'adapter' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\Adapter\\AmazonPaymentAdapter',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Http\\TransferFactory' => 
    array (
      'transferBuilder' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Http\\TransferBuilder',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Request\\AuthorizationRequestBuilder' => 
    array (
      'config' => 
      array (
        '_i_' => 'AmazonGatewayConfig',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'amazonConfig' => 
      array (
        '_i_' => 'Amazon\\Core\\Model\\AmazonConfig',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'categoryExclusion' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\CategoryExclusion',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Request\\RefundRequestBuilder' => 
    array (
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
      'orderAdapterFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Data\\Order\\OrderAdapterFactory',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Request\\SettlementRequestBuilder' => 
    array (
      'config' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
      'quoteRepository' => 
      array (
        '_i_' => 'Magento\\Quote\\Model\\QuoteRepository\\Interceptor',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Request\\VoidRequestBuilder' => 
    array (
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Response\\CompleteAuthHandler' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'pendingAuthorizationFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingAuthorizationInterfaceFactory',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Response\\CompleteSaleHandler' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'pendingAuthorizationFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingAuthorizationInterfaceFactory',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Response\\RefundHandler' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'messageManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Message\\Manager',
      ),
      'pendingRefundFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingRefundInterfaceFactory',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Response\\SettlementHandler' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
      'quoteRepository' => 
      array (
        '_i_' => 'Magento\\Quote\\Model\\QuoteRepository\\Interceptor',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Response\\VoidHandler' => 
    array (
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'messageManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Message\\Manager',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Validator\\AuthorizationValidator' => 
    array (
      'resultFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Validator\\ResultInterfaceFactory',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Validator\\ConstraintValidator' => 
    array (
      'resultFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Validator\\ResultInterfaceFactory',
      ),
    ),
    'Amazon\\Payment\\Gateway\\Validator\\CurrencyValidator' => 
    array (
      'resultFactory' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\Validator\\ResultInterfaceFactory',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Payment\\Gateway\\ConfigInterface',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Payment\\Helper\\Address' => 
    array (
      'addressFactory' => 
      array (
        '_i_' => 'Magento\\Customer\\Api\\Data\\AddressInterfaceFactory',
      ),
      'regionFactory' => 
      array (
        '_i_' => 'Magento\\Directory\\Model\\RegionFactory',
      ),
      'regionDataFactory' => 
      array (
        '_i_' => 'Magento\\Customer\\Api\\Data\\RegionInterfaceFactory',
      ),
      'config' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Config\\Interceptor',
      ),
    ),
    'Amazon\\Payment\\Helper\\Data' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'moduleList' => 
      array (
        '_i_' => 'Magento\\Framework\\Module\\ModuleList',
      ),
    ),
    'Amazon\\Payment\\Helper\\Email' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\Helper\\Context',
      ),
      'emailTransportBuilderFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Mail\\Template\\TransportBuilderFactory',
      ),
      'amazonCoreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
    ),
    'Amazon\\Payment\\Helper\\Shortcut\\CheckoutValidator' => 
    array (
      'checkoutSession' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Interceptor',
      ),
      'shortcutValidator' => 
      array (
        '_i_' => 'Amazon\\Payment\\Helper\\Shortcut\\Validator',
      ),
      'paymentData' => 
      array (
        '_i_' => 'Magento\\Payment\\Helper\\Data\\Interceptor',
      ),
    ),
    'Amazon\\Payment\\Helper\\Shortcut\\Factory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
    ),
    'Amazon\\Payment\\Helper\\Shortcut\\Validator' => 
    array (
      'amazonConfig' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'productTypeConfig' => 
      array (
        '_i_' => 'Magento\\Catalog\\Model\\ProductTypes\\Config',
      ),
      'paymentData' => 
      array (
        '_i_' => 'Magento\\Payment\\Helper\\Data\\Interceptor',
      ),
      'categoryExclusionHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\CategoryExclusion',
      ),
    ),
    'Amazon\\Payment\\Ipn\\IpnHandler' => 
    array (
      'requestHeaders' => 
      array (
        '_vn_' => true,
      ),
      'requestBody' => 
      array (
        '_vn_' => true,
      ),
      'ipnConfig' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Ipn\\IpnHandlerFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'logger' => 
      array (
        '_i_' => 'Amazon\\Core\\Logger\\IpnLogger',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\AmazonPay\\IpnHandlerInterface',
      ),
    ),
    'Amazon\\Payment\\Model\\Adapter\\AmazonPaymentAdapter' => 
    array (
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'amazonCaptureResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonCaptureResponseFactory',
      ),
      'amazonSetOrderDetailsResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonSetOrderDetailsResponseFactory',
      ),
      'amazonAuthorizationResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonAuthorizationResponseFactory',
      ),
      'pendingCaptureFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingCaptureInterfaceFactory',
      ),
      'pendingAuthorizationFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingAuthorizationInterfaceFactory',
      ),
      'subjectReader' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Helper\\SubjectReader',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Payment\\Model\\Method\\Logger',
      ),
      'urlBuilder' => 
      array (
        '_vn_' => true,
      ),
      'orderLinkFactory' => 
      array (
        '_vn_' => true,
      ),
      'orderRepository' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\AddressManagement' => 
    array (
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'addressHelper' => 
      array (
        '_i_' => 'Amazon\\Payment\\Helper\\Address',
      ),
      'quoteLinkFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\QuoteLinkInterfaceFactory',
      ),
      'session' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Interceptor',
      ),
      'countryCollectionFactory' => 
      array (
        '_i_' => 'Magento\\Directory\\Model\\ResourceModel\\Country\\CollectionFactory',
      ),
      'amazonAddressFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Domain\\AmazonAddressFactory',
      ),
      'validatorFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Validator\\Factory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'addressFactory' => 
      array (
        '_i_' => 'Magento\\Customer\\Model\\AddressFactory',
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\AuthorizationProcessor' => 
    array (
      'amazonAuthorizationDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonAuthorizationDetailsFactory',
      ),
      'authorization' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\PaymentManagement\\Authorization',
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\ResourceModel\\PendingAuthorization\\CollectionFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\AuthorizationProcessor\\Proxy' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\Ipn\\AuthorizationProcessor',
      ),
      'shared' => 
      array (
        '_v_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\CaptureProcessor' => 
    array (
      'amazonCaptureDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonCaptureDetailsFactory',
      ),
      'capture' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\PaymentManagement\\Capture',
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\ResourceModel\\PendingCapture\\CollectionFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\CaptureProcessor\\Proxy' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\Ipn\\CaptureProcessor',
      ),
      'shared' => 
      array (
        '_v_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\CompositeProcessor' => 
    array (
      'processors' => 
      array (
        '_vac_' => 
        array (
          'captureprocessor' => 
          array (
            '_i_' => 'Amazon\\Payment\\Model\\Ipn\\CaptureProcessor\\Proxy',
          ),
          'authorizationprocessor' => 
          array (
            '_i_' => 'Amazon\\Payment\\Model\\Ipn\\AuthorizationProcessor\\Proxy',
          ),
          'orderprocessor' => 
          array (
            '_i_' => 'Amazon\\Payment\\Model\\Ipn\\OrderProcessor\\Proxy',
          ),
          'refundprocessor' => 
          array (
            '_i_' => 'Amazon\\Payment\\Model\\Ipn\\RefundProcessor\\Proxy',
          ),
        ),
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\OrderProcessor' => 
    array (
      'amazonOrderDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonOrderDetailsFactory',
      ),
      'authorization' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\PaymentManagement\\Authorization',
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\ResourceModel\\PendingAuthorization\\CollectionFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\OrderProcessor\\Proxy' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\Ipn\\OrderProcessor',
      ),
      'shared' => 
      array (
        '_v_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\RefundProcessor' => 
    array (
      'amazonRefundDetailsFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Details\\AmazonRefundDetailsFactory',
      ),
      'queuedRefundUpdater' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\QueuedRefundUpdater',
      ),
      'collectionFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\ResourceModel\\PendingRefund\\CollectionFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
    ),
    'Amazon\\Payment\\Model\\Ipn\\RefundProcessor\\Proxy' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\Ipn\\RefundProcessor',
      ),
      'shared' => 
      array (
        '_v_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\OrderInformationManagement' => 
    array (
      'session' => 
      array (
        '_i_' => 'Magento\\Checkout\\Model\\Session\\Interceptor',
      ),
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'config' => 
      array (
        '_i_' => 'Amazon\\Payment\\Gateway\\Config\\Config',
      ),
      'amazonSetOrderDetailsResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonSetOrderDetailsResponseFactory',
      ),
      'quoteLinkFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\QuoteLinkInterfaceFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'productMetadata' => 
      array (
        '_i_' => 'Magento\\Framework\\App\\ProductMetadata',
      ),
      'urlBuilder' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\OrderLink' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Model\\OrderLinkFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\OrderLink',
      ),
    ),
    'Amazon\\Payment\\Model\\PaymentManagement' => 
    array (
      'pendingCaptureFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingCaptureInterfaceFactory',
      ),
      'pendingAuthorizationFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingAuthorizationInterfaceFactory',
      ),
      'pendingRefundFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingRefundInterfaceFactory',
      ),
      'searchCriteriaBuilderFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilderFactory',
      ),
      'orderPaymentRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Repository',
      ),
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
      'transactionRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Transaction\\Repository',
      ),
    ),
    'Amazon\\Payment\\Model\\PaymentManagement\\Authorization' => 
    array (
      'notifier' => 
      array (
        '_i_' => 'Magento\\Framework\\Notification\\NotifierPool',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'searchCriteriaBuilderFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilderFactory',
      ),
      'invoiceRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\InvoiceRepository\\Interceptor',
      ),
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'pendingAuthorizationFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingAuthorizationInterfaceFactory',
      ),
      'amazonAuthorizationDetailsResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonAuthorizationDetailsResponseFactory',
      ),
      'amazonAuthorizationValidator' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\Validator\\AmazonAuthorization',
      ),
      'orderPaymentRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Repository',
      ),
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'amazonGetOrderDetailsResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonGetOrderDetailsResponseFactory',
      ),
      'paymentManagement' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\PaymentManagement',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'adapter' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\Adapter\\AmazonPaymentAdapter',
      ),
    ),
    'Amazon\\Payment\\Model\\PaymentManagement\\Capture' => 
    array (
      'notifier' => 
      array (
        '_i_' => 'Magento\\Framework\\Notification\\NotifierPool',
      ),
      'urlBuilder' => 
      array (
        '_i_' => 'Magento\\Backend\\Model\\Url',
      ),
      'searchCriteriaBuilderFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Api\\SearchCriteriaBuilderFactory',
      ),
      'invoiceRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\InvoiceRepository\\Interceptor',
      ),
      'clientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'pendingCaptureFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingCaptureInterfaceFactory',
      ),
      'amazonCaptureDetailsResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonCaptureDetailsResponseFactory',
      ),
      'orderPaymentRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Repository',
      ),
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
      'transactionRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Transaction\\Repository',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'paymentManagement' => 
      array (
        '_i_' => 'Amazon\\Payment\\Model\\PaymentManagement',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
    ),
    'Amazon\\Payment\\Model\\PaymentManagement\\Proxy' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\PaymentManagement',
      ),
      'shared' => 
      array (
        '_v_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\PendingAuthorization' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'dateFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime\\DateTimeFactory',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Model\\PendingCapture' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'dateFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime\\DateTimeFactory',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Model\\PendingRefund' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'dateFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Stdlib\\DateTime\\DateTimeFactory',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Model\\QueuedRefundUpdater' => 
    array (
      'orderRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\OrderRepository\\Interceptor',
      ),
      'orderPaymentRepository' => 
      array (
        '_i_' => 'Magento\\Sales\\Model\\Order\\Payment\\Repository',
      ),
      'amazonHttpClientFactory' => 
      array (
        '_i_' => 'Amazon\\Core\\Client\\ClientFactory',
      ),
      'amazonRefundDetailsResponseFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Domain\\AmazonRefundDetailsResponseFactory',
      ),
      'adminNotifier' => 
      array (
        '_i_' => 'Magento\\Framework\\Notification\\NotifierInterface\\Proxy',
      ),
      'pendingRefundFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\PendingRefundInterfaceFactory',
      ),
      'storeManager' => 
      array (
        '_i_' => 'Magento\\Store\\Model\\StoreManager',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
    ),
    'Amazon\\Payment\\Model\\QueuedRefundUpdaterFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\QueuedRefundUpdater',
      ),
    ),
    'Amazon\\Payment\\Model\\QuoteLink' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\Context',
      ),
      'registry' => 
      array (
        '_i_' => 'Magento\\Framework\\Registry',
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
      'resourceCollection' => 
      array (
        '_vn_' => true,
      ),
      'data' => 
      array (
        '_v_' => 
        array (
        ),
      ),
    ),
    'Amazon\\Payment\\Model\\QuoteLinkManagement' => 
    array (
      'cartExtensionFactory' => 
      array (
        '_i_' => 'Magento\\Quote\\Api\\Data\\CartExtensionFactory',
      ),
      'quoteLinkFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\QuoteLinkInterfaceFactory',
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\OrderLink' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_v_' => 'sales',
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingAuthorization' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingAuthorization\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingAuthorization\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\ResourceModel\\PendingAuthorization\\Collection',
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingCapture' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingCapture\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingCapture\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\ResourceModel\\PendingCapture\\Collection',
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingRefund' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingRefund\\Collection' => 
    array (
      'entityFactory' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\EntityFactory',
      ),
      'logger' => 
      array (
        '_i_' => 'Magento\\Framework\\Logger\\Monolog',
      ),
      'fetchStrategy' => 
      array (
        '_i_' => 'Magento\\Framework\\Data\\Collection\\Db\\FetchStrategy\\Query',
      ),
      'eventManager' => 
      array (
        '_i_' => 'Magento\\Framework\\Event\\Manager\\Proxy',
      ),
      'connection' => 
      array (
        '_vn_' => true,
      ),
      'resource' => 
      array (
        '_vn_' => true,
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\PendingRefund\\CollectionFactory' => 
    array (
      'objectManager' => 
      array (
        '_i_' => 'Magento\\Framework\\ObjectManagerInterface',
      ),
      'instanceName' => 
      array (
        '_v_' => '\\Amazon\\Payment\\Model\\ResourceModel\\PendingRefund\\Collection',
      ),
    ),
    'Amazon\\Payment\\Model\\ResourceModel\\QuoteLink' => 
    array (
      'context' => 
      array (
        '_i_' => 'Magento\\Framework\\Model\\ResourceModel\\Db\\Context',
      ),
      'connectionName' => 
      array (
        '_v_' => 'checkout',
      ),
    ),
    'Amazon\\Payment\\Observer\\AddAmazonButton' => 
    array (
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'shortcutFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Helper\\Shortcut\\Factory',
      ),
    ),
    'Amazon\\Payment\\Observer\\DataAssignObserver' => NULL,
    'Amazon\\Payment\\Observer\\HardDeclinedEmailSender' => 
    array (
      'emailHelper' => 
      array (
        '_i_' => 'Amazon\\Payment\\Helper\\Email',
      ),
    ),
    'Amazon\\Payment\\Observer\\IgnoreBillingAddressValidation' => NULL,
    'Amazon\\Payment\\Observer\\KlarnaKcoOverride' => 
    array (
      'coreHelper' => 
      array (
        '_i_' => 'Amazon\\Core\\Helper\\Data',
      ),
      'sessionHelper' => 
      array (
        '_i_' => 'Amazon\\Login\\Helper\\Session',
      ),
    ),
    'Amazon\\Payment\\Observer\\LoadOrder' => 
    array (
      'orderExtensionFactory' => 
      array (
        '_i_' => 'Magento\\Sales\\Api\\Data\\OrderExtensionFactory',
      ),
      'orderLinkFactory' => 
      array (
        '_i_' => 'Amazon\\Payment\\Api\\Data\\OrderLinkInterfaceFactory',
      