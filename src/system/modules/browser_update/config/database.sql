-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------


-- 
-- Table `tl_layout`
-- 


CREATE TABLE `tl_layout` (
  `browserUpdateEnabled` varchar(1) NOT NULL default '',
  `browserUpdateTest` varchar(11) NOT NULL default 'deaktiviert',
  `browserUpdateIE` varchar(5) NOT NULL default 'auto',
  `browserUpdateFirefox` varchar(5) NOT NULL default 'auto',
  `browserUpdateOpera` varchar(5) NOT NULL default 'auto',
  `browserUpdateSafari` varchar(5) NOT NULL default 'auto',
  `browserUpdatePeriod` int(4) NOT NULL default '60'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;