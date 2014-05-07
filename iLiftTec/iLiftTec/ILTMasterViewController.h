//
//  ILTMasterViewController.h
//  iLiftTec
//
//  Created by Ivan Diaz on 3/23/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface ILTMasterViewController : UITableViewController <UITableViewDelegate, UITableViewDataSource>

@property(nonatomic) UITableViewCellAccessoryType accessoryType;


-(void) updateDia: (NSInteger) dia ejercicio: (NSInteger) ejercicio completado: (BOOL) completad;

@end
